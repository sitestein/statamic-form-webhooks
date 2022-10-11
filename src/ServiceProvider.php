<?php

namespace Sitestein\FormWebhooks;

use Sitestein\Core\FormSubmission;
use Statamic\Events\SubmissionCreated;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{

    protected $listen = [
        SubmissionCreated::class => [FormSubmission::class],
    ];

    public function bootAddon()
    {
        //
    }
}
