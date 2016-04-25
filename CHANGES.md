# Release History

## 1.1.0 (...)
- add `readFolder` method to get a list of all files in a folder
- no longer wrap exception path in `htmlentities`
- add `isFile` method to determine if a file exists

## 1.0.2 (2016-03-25)
- do no longer use openssl functions for getting random data and
  always use random_bytes, or polyfill

## 1.0.1 (2015-10-03)
- use `random_bytes` if available (PHP >= 7)

## 1.0.0 (2015-07-21)
- initial release
