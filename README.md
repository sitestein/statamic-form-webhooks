# Statamic Form Webhooks

> Form Webhooks is a Statamic addon that pushes data from a form submission to a specified webhook.

Form Webhooks can be usefull to send form data to a CRM, mailinglist or other service. 

You could create webhooks with Make.com or Zapier and send form data to your desired integration, this allows you to;

- Collect e-mailadresses and add them to a Mailchimp mailinglist
- Notify Slack channels of a new form submission
- Collect prospects to your CRM

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following commands from your project root:

``` bash
composer require sitestein/statamic-form-webhooks
```

``` bash
php artisan vendor:publish --tag=statamic-form-webhooks-config
```


## How to Use

After you installed the package and run the publish command, you can find the config file in `config/statamic-form-webhooks.php`.
Here you can add a new webhook by adding a new item to `webhooks` array.

Example:
```php
 [
    // ...
    'webhooks' => [
        // ...
        'newsletter' => 'https://hook.eu1.make.com/loremipsum',
    ]
 ]

```

Now all submissions from the form with the handle `newsletter` will be send to the webhook. If you use Make.com for example, you can create a webhook and see the form data, which you can map to your desired integration.
This package also integrates with Ray for debugging, if you have Ray installed, just open the app and submit a form.
