# Release History

## 2.0.0 (...)
- update the interface also for new `writeFile`

## 1.2.0 (2016-04-27)
- `writeFile` now has the option to create the parent director(y)(ies) if it 
  does not exist

## 1.1.0 (2016-04-25)
- add `readFolder` method to get a list of all files in a folder
- no longer wrap exception path in `htmlentities`
- add `isFile` method to determine if a file exists
- add IOInterface to allow for easy testable implementations

## 1.0.2 (2016-03-25)
- do no longer use openssl functions for getting random data and
  always use random_bytes, or polyfill

## 1.0.1 (2015-10-03)
- use `random_bytes` if available (PHP >= 7)

## 1.0.0 (2015-07-21)
- initial release
