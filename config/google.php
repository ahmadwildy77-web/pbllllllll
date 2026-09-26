<?php

return [
    'calendar_id' => env('GOOGLE_CALENDAR_ID', 'primary'),
    'service_account_json' => env('GOOGLE_SERVICE_ACCOUNT_JSON', 'storage/app/google/service-account.json'),
];
