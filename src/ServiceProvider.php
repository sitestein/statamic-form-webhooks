<?php

namespace Sitestein\FormWebhooks;

use Statamic\Events\SubmissionCreated;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{

    protected $listen = [
        SubmissionCreated::class => [FormSubmission::class],
    ];

}
