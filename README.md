# Kntnt Session Campaign Parameters

WordPress plugin that provides API to retrieve Google or Matomo campaign parameters (i.e., UTM or MTM, respectively) sent during the current session.

## Description

This plugin saves the campaign parameters from [Google (UTM)](https://ga-dev-tools.google/campaign-url-builder/) and [Matomo (MTM)](https://matomo.org/faq/tracking-campaigns-url-builder/) that are contained in the URL for each user and for the duration of their session. The plugin provides a simple API to retrieve any campaign parameters anytime. It is also possible to add or remove parameters that are saved and can be retrieved.

A typical use case for the plugin is to track the source of a completed form:

You have a digital ad with a call to action to click on a link. The link takes the visitor to a landing page with a lead form. The link has campaign parameters allowing you to track which campaign and medium brought the visitor to the page.

Suppose the visitor navigates to other pages instead of filling in the form. In that case, the information will be lost unless the campaign parameters are saved, which this plugin does.

The plugin saves the campaign parameters and allows you to retrieve them later, such as attaching them as hidden fields in a form. Note that this form does not have to be the same as the landing page.

#### Supported UTM parameters

* utm_source
* utm_medium
* utm_campaign
* utm_id
* utm_term
* utm_content

#### Supported MTM parameters

* mtm_campaign
* mtm_cid
* mtm_content
* mtm_group
* mtm_kwd
* mtm_medium
* mtm_placement
* mtm_source

## API

### Function get()

`\Kntnt\Session_Campaign_Parameters\get( 'param' )` returns the value of the named camping parameter (`param`) if such campaign parameter has been sent with any GET request during the current session. Otherwise, it returns `null`.

`\Kntnt\Session_Campaign_Parameters\get( 'param_1', 'param_2', … )` returns an array equivalent to `[ \Kntnt\Session_Campaign_Parameters\get( 'param_1' ), \Kntnt\Session_Campaign_Parameters\get( 'param_2' ), … ]`.

`\Kntnt\Session_Campaign_Parameters\get()` returns an array equivalent to `\Kntnt\Session_Campaign_Parameters\get( \Kntnt\Session_Campaign_Parameters\parameters() )`.

### Function parameters()

`\Kntnt\Session_Campaign_Parameters\parameters()` returns an array of all campaign parameters managed by the plugin. Notice that this array is subject to the `kntnt-session-campaign-parameters` described below.

### Filter kntnt-session-campaign-parameters

You can filter the campaign parameters managed with `add_filter( 'kntnt-session-campaign-parameters', $parameters )`.

## Requirements

This plugin requires PHP 7.4 or later.

This plugin has no dependencies. However, it uses [PHP sessions](https://www.php.net/manual/en/book.session.php). Therefore, install and activate Pantheon's *[WordPress Native PHP Sessions](https://wordpress.org/plugins/wp-native-php-sessions/)* plugin for better performance and scalability.

## Installation

Follow these instructions to install it as a regular plugin or a [must-use plugin](https://wordpress.org/documentation/article/must-use-plugins/).

### Regular plugin

1. [Download the plugin from GitHub.](https://github.com/Kntnt/kntnt-session-campaign-parameters/releases/latest)
2. Unzip the zip file.
3. Rename the folder to kntnt-session-campaign-parameters.
4. Create a new zip file of the folder.
5. [Upload the newly created zip file through WordPress Admin](https://wordpress.org/documentation/article/manage-plugins/#upload-via-wordpress-admin).

### Must-use-plugin

Download [kntnt-session-campaign-parameters.php](https://raw.githubusercontent.com/Kntnt/kntnt-session-campaign-parameters/main/kntnt-session-campaign-parameters.php) and upload it to `wp-content/mu-plugins.` If the directory is missing, create it.

## Changelog

### 1.0.0

* Initial release
