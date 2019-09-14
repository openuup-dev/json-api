UUP dump JSON API
-----------------

### Description
A simple endpoint allowing access of the UUP dump API using HTTP requests.

### Usage
All requests are done using GET requests with parameters specified in the URL.
Response is provided as an JSON.

Example response:
```json
{
  "response": {
    "apiVersion": "1.27.0"
  },
  "jsonApiVersion": "0.1.0-alpha"
}
```

Responses from the UUP dump API are always returned in the `response` key.

If requests fails, a HTTP error code will be set to:
  - `400` if request was malformed
  - `429` if user is being rate limited
  - `500` if retrieval of data was unsuccessful

In such cases `response` key will contain an `error` key with short description
of the error.

### Supported endpoints
#### `/` or `/index.php`
Returns versions of APIs

Parameters:
  - None

#### `/listid.php`
Returns a list of builds in the local database.

Parameters:
 - `search` - Search query (optional)
   - **Supported values:** any text

 - `sortByDate` - Sort results by creation date (optional)
   - **Supported values:** 0 = Disable, 1 = Enable

#### `/fetchupd.php`
Fetches the latest builds from Windows Update servers using specified
parameters.

Parameters:
 - `arch` - Architecture of build to find
   - **Supported values:** `amd64`, `arm64`, `x86`

 - `ring` - Ring to use when fetching information
   - **Supported values:** `WIF`, `WIS`, `RP`, `RETAIL`

 - `flight` - Flight to use when fetching information
   - **Supported values:** `Active`, `Skip`, `Current`
   - **NOTE:** `Skip` is for `WIF` ring only. `Current` is for `RP` ring only.

 - `build` - Build number to use when fetching information
   - **Supported values:** >= 9841 and <= PHP_INT_MAX-1

 - `sku` - SKU number to use when fetching information
   - **Supported values:** Any integer

#### `/get.php`
Retrieves download links for specified Update ID and provides lists of ready to
use UUP sets.

Parameters:
 - `id` - Update identifier
   - **Supported values:** any update identifier

 - `lang` - Create UUP set for selected language (optional)
   - **Supported values:** language name in xx-xx format

 - `edition` - Create UUP set for selected edition (optional)
   - **Supported values:** any edition name
   - **NOTE:** You need to specify `lang` to get successful request

#### `/listlangs.php`
Lists available languages for specified Update ID

Parameters:
 - `id` - Update identifier (optional)
   - **Supported values:** any update identifier


#### `/listlangs.php`
Lists available editions for specified Update ID

Parameters:
 - `lang` - Generate list for selected language
   - **Supported values:** language name in xx-xx format

 - `id` - Update identifier (optional)
   - **Supported values:** any update identifier
