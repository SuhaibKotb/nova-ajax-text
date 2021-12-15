## Install
```
composer require suhaib-kotb/nova-ajax-text
```

## Usage
Specify a request url, and the parent($attribute) to watch.

``` 
use SuhaibKotb\NovaAjaxText\AjaxText;
```

```
Text::make('National ID', 'national_id'),

AjaxText::make('Full Name', 'name')
    ->parent('national_id')
    ->get('/api/users/{national_id}/name'),
```
## Request Url:
In the above example, we say `national_id` is the parent.
The `{national_id}` url parameter will equal the `National ID` field value.

## Response Format:
```
Route::get('/api/users/{national_id}/{property}', function($national_id, $property) {
    $user = \App\User::where('national_id', $national_id)->first();
    return $user->$property ?? '';  // it equal to $user->name;
})->middleware(['nova']);
```

## Always Disabled:
You can use alwaysDisabled option if you don't need to edit the vlaue.
```
Text::make('National ID', 'national_id'),

AjaxText::make('Full Name', 'name')
    ->alwaysDisabled()
    ->parent('national_id')
    ->get('/api/users/{national_id}/name'),
```
