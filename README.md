# scrobbles-importer
Import your scrobbles into a Laravel codebase.

**Please Note**: This is a personal itch that I wanted to scratch and is not meant to be a fully-fledged thing out of the box. It will import your scrobbles a bit at a time and keep them in a database. The database structure is just one I decided for myself - feel free to edit things for your own needs. 200 is the maximum number of scrobbles that can be imported per API request, which is a limit of the Last.FM API.


This currently only supports importing public scrobbles from a Last.FM account.

No Authentication with Last.FM is needed.

## Required Environment Variables
`LASTFM_API_KEY`: Your own Last.FM API Key

`LASTFM_API_SECRET`: Your own Last.FM API Secret

`LASTFM_IMPORT_LIMIT`: How many listens to import per API request (Max limit is 200)

`LASTFM_IMPORT_USERNAME`: The User Name of the public profile whose scrobbles you want to import.

`SCROBBLE_BACKDATE`: [TRUE|FALSE]: Whether to Import your past scrobbles first. Switch back to false when backdating is done in order to run the importer as normal.

## Getting up and running

1. Place this code on a server of your choice
2. Run the migrations
3. Manually create your account with `php artisan tinker` (See Laravel docs if needed)
4. Add the required Environment variables to your own `.env` file with the correct values
5. Set `SCROBBLE_BACKDATE` to TRUE.
6. Start a cron job like this *example*: `php /path/to/laravel/artisan schedule:run` to run every minute.
7. Using the terminal and `php artisan tinker` again, keep running `\App\Scrobble::count()` every few minutes until the number matches, or is near enough to, the total number of scrobbles on your Last.FM page.
8. Once backdating is done, change `SCROBBLE_BACKDATE` to FALSE, but leave the cron running.
9. Done. Your database will now be getting your updated scrobbles every minute.

## Notes

This is just a standard Laravel 5.8 codebase - feel free to edit things for your own needs.

- I added `abort(404)` to the `App\Http\Controllers\Auth\RegisterController::__construct` to stop any registrations.
- I also hid the register link on the front end.

Hope this is helpful.



Peace!
