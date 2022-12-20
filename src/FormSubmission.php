<?php

namespace Sitestein\FormWebhooks;

use Statamic\Events\SubmissionCreated;
use Illuminate\Support\Facades\Http;

class FormSubmission
{
    /**
     * @param SubmissionCreated $event
     * @return void
     */
    public function handle(SubmissionCreated $event)
    {
        $submission = $event->submission;
        $handle = $submission->form->handle;

        if (!config("statamic-form-webhooks.webhooks.{$handle}")) {
            return;
        }

        $data = $submission->data();

        $url = config("statamic-form-webhooks.webhooks.{$handle}.url");
        $fields = config("statamic-form-webhooks.webhooks.{$handle}.fields", '*');
        $conditions = config("statamic-form-webhooks.webhooks.{$handle}.if");

        if (! $url) {
            return;
        }

        if ($conditions && ! $this->conditionsMet($submission, $conditions)) {
            return;
        }

        if ($fields && $fields !== '*') {
            $data = $data->only($fields);
        }

        $response = Http::post($url, $data->toArray());

        if (function_exists('ray')) {
            ray(
                "[Sitestein\FormWebhooks]",
                "Form submission '{$handle}' sent to '{$url}'",
                "Fields: {$data->toJson()}",
                "Response code: {$response->status()}", "Response body: {$response->body()}"
            );
        }
    }

    /**
     * @param $submission
     * @param $conditions
     * @return bool
     */
    protected function conditionsMet($submission, $conditions)
    {
        foreach ($conditions as $key => $value) {
            if (data_get($submission->data(), $key) !== $value) {
                return false;
            }
        }

        return true;
    }
}
