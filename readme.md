UUP dump JSON API
-----------------

### Description
A simple endpoint allowing access to the UUP dump API using simple HTTP GET requests.

### Usage
All requests are done using GET requests with parameters specified in the URL.
Responses are provided in JSON format.

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

If request fails, a HTTP error code will be set to:
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
Returns a list of builds in the local database. (like "Browse the list of known builds" on the website)

Parameters:
 - `search` - Optional search query
   - **Supported values:** any text

 - `sortByDate` - Optional sorting results by creation date
   - **Supported values:** 0 = Disable, 1 = Enable

#### `/fetchupd.php`
Fetches the latest builds from Windows Update servers using specified
parameters. (like "Fetch the latest build" on the website)

Parameters:
 - `arch` - Specifies which architecture the API will return.
   - **Supported values:** `amd64`, `arm64`, `x86`

 - `ring` - Specifies the ring the API uses when querying Windows Update servers.
   - **Supported values:** `WIF`, `WIS`, `RP`, `RETAIL`
    - `WIF` - Windows Insider Fast
    - `WIS` - Windows Insider Slow
    - `RP` - Release Preview
    - `RETAIL` - Retail

 - `flight` - Flight to use when fetching information
   - **Supported values:** `Active`, `Skip`, `Current`
   - **NOTE:** `Skip` is for `WIF` ring only. `Current` is for `RP` ring only.

 - `build` - Build number to use by the API when fetching information
   - **Supported values:** >= 9841 and <= PHP_INT_MAX-1

 - `sku` - SKU number to use when fetching information
   - **Supported values:** Any SKU integer

#### `/get.php`
Retrieves download links for specified Update ID and provides lists of ready to
use UUP sets.

Parameters:
 - `id` - Update identifier (UUIDv4 string)
   - **Supported values:** Any valid update identifier in the UUIDv4 format.

 - `lang` - Create UUP set for selected language (optional)
   - **Supported values:** language name in xx-xx format

 - `edition` - Create UUP set for the selected edition (optional)
   - **Supported values:** Any edition name
   - **NOTE:** Must be used with `lang`

 - `noLinks` - Do not retrieve download links for the created UUP set (optional)
   - **Supported values:** 0 = Disable, 1 = Enable

#### `/listlangs.php`
Lists available languages for the specified Update ID.

Parameters:
 - `id` - Optional Update identifier (UUIDv4 string)
   - **Supported values:** Any valid update identifier in the UUIDv4 format.


#### `/listlangs.php`
Lists available editions for the specified Update ID.

Parameters:
- `lang` - Generate edition list for the selected language
   - **Supported values:** Language name in xx-xx format

 - `id` - Optional update identifier (UUIDv4 string)
   - **Supported values:** Any valid update identifier in the UUIDv4 format.
