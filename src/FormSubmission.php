<?php

namespace Sitestein\FormWebhooks;

use Statamic\Events\SubmissionCreated;
use Illuminate\Support\Facades\Http;

class FormSubmission
{
    public function handle(SubmissionCreated $event)
    {
        $submission = $event->submission;
        $handle = $submission->form->handle;

        // check if handle exists in config
        if (!$webhook = config('statamic-form-webhooks.webhooks.' . $handle)) {
            return;
        }

        $response = Http::post($webhook, $submission->data()->toArray());

        if (function_exists('ray')) {
            ray("[Sitestein\FormWebhooks]: Form submission '{$handle}' sent to '{$webhook}'", "Response code: {$response->status()}", "Response body: {$response->body()}");
        }
    }
}
