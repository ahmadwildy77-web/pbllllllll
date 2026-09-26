<?php

namespace App\Services;

use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use Illuminate\Support\Facades\Log;

class GoogleCalendarService
{
    protected ?Calendar $service = null;
    protected string $calendarId;

    public function __construct()
    {
        $this->calendarId = config('google.calendar_id', 'primary');
    }

    /**
     * Inisialisasi Google Calendar Service via Service Account.
     */
    protected function getService(): ?Calendar
    {
        if ($this->service) {
            return $this->service;
        }

        $jsonPath = base_path(config('google.service_account_json'));

        if (!file_exists($jsonPath)) {
            Log::warning('Google Service Account JSON tidak ditemukan: ' . $jsonPath);
            return null;
        }

        try {
            $client = new Client();
            $client->setAuthConfig($jsonPath);
            $client->setScopes([Calendar::CALENDAR]);
            $client->setSubject(null);

            $this->service = new Calendar($client);
            return $this->service;
        } catch (\Exception $e) {
            Log::error('Gagal inisialisasi Google Calendar: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Ambil semua event dari Google Calendar.
     */
    public function listEvents(int $maxResults = 50): array
    {
        $service = $this->getService();
        if (!$service) return [];

        try {
            $results = $service->events->listEvents($this->calendarId, [
                'maxResults' => $maxResults,
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'timeMin' => now()->startOfYear()->toRfc3339String(),
            ]);

            return $results->getItems() ?? [];
        } catch (\Exception $e) {
            Log::error('Gagal mengambil events: ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Buat event baru di Google Calendar.
     * Jika $isRecurring = true, akan dibuat sebagai recurring event tahunan.
     */
    public function createEvent(string $title, string $description, string $startDate, string $endDate = null, string $url = null, bool $isRecurring = false): ?Event
    {
        $service = $this->getService();
        if (!$service) return null;

        $endDate = $endDate ?? $startDate;

        $event = new Event([
            'summary' => $title,
            'description' => $description . ($url ? "\n\nLink: {$url}" : ''),
            'start' => new EventDateTime([
                'date' => $startDate, // Format: YYYY-MM-DD (all-day event)
                'timeZone' => 'Asia/Jakarta',
            ]),
            'end' => new EventDateTime([
                'date' => $endDate,
                'timeZone' => 'Asia/Jakarta',
            ]),
        ]);

        // Recurring tahunan: RRULE format RFC 5545
        if ($isRecurring) {
            $event->setRecurrence(['RRULE:FREQ=YEARLY;COUNT=5']);
        }

        try {
            $created = $service->events->insert($this->calendarId, $event);
            return $created;
        } catch (\Exception $e) {
            Log::error('Gagal membuat event: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Update event di Google Calendar.
     */
    public function updateEvent(string $eventId, array $data): ?Event
    {
        $service = $this->getService();
        if (!$service) return null;

        try {
            $event = $service->events->get($this->calendarId, $eventId);

            if (isset($data['summary'])) $event->setSummary($data['summary']);
            if (isset($data['description'])) $event->setDescription($data['description']);
            if (isset($data['start'])) {
                $event->setStart(new EventDateTime(['date' => $data['start'], 'timeZone' => 'Asia/Jakarta']));
            }
            if (isset($data['end'])) {
                $event->setEnd(new EventDateTime(['date' => $data['end'], 'timeZone' => 'Asia/Jakarta']));
            }

            return $service->events->update($this->calendarId, $eventId, $event);
        } catch (\Exception $e) {
            Log::error('Gagal update event: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Hapus event dari Google Calendar.
     */
    public function deleteEvent(string $eventId): bool
    {
        $service = $this->getService();
        if (!$service) return false;

        try {
            $service->events->delete($this->calendarId, $eventId);
            return true;
        } catch (\Exception $e) {
            Log::error('Gagal hapus event: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Sinkronkan event dari Google Calendar ke tabel lombas.
     */
    public function syncToDatabase(): array
    {
        $events = $this->listEvents(100);
        $synced = [];

        foreach ($events as $event) {
            $start = $event->getStart()->getDate() ?? $event->getStart()->getDateTime();
            
            $lomba = \App\Models\Lomba::updateOrCreate(
                ['google_event_id' => $event->getId()],
                [
                    'nama_lomba' => $event->getSummary(),
                    'deskripsi' => $event->getDescription(),
                    'deadline' => $start,
                ]
            );

            $synced[] = $lomba->nama_lomba;
        }

        return $synced;
    }
}
