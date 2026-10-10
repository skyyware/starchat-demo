---
id: stage-files
entity: stage
title: 'File uploads and downloads'
source: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/files.md'
retrieved_at: '2026-10-09T00:00:00+02:00'
review_status: reviewed
source_version: "skyyware/stage v0.1.5"
public_path: /resources/files
topic_terms:
  - upload
  - download
  - file
  - files
  - range
  - media
  - streaming
phrase_terms: []
keywords:
  - upload
  - download
  - file
  - files
  - range
  - media
  - streaming
links:
  -
    label: 'File uploads and downloads — Stage guide'
    url: 'https://stage.dev/resources/files'
  -
    label: 'File transfer guide'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/files.md'
  -
    label: 'File response implementation'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/FileResponse.php'
  -
    label: 'Upload implementation'
    url: 'https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/UploadedFile.php'
based_on: []
---

# File uploads and downloads

Applies to Stage 0.1.5. Uploads and attachment downloads arrived in 0.1.3.
Inline media with byte ranges arrived in 0.1.5. Sources checked on 9 October 2026.

`UploadedFile::fromPhp($_FILES['file'] ?? [], maxBytes: $limit)` validates one
native PHP upload. It checks upload errors, the actual size, and the client
filename. Nested multiple-file arrays are rejected. Empty uploads are allowed
when they fit the byte limit.

The returned `path`, `name`, and `size` do not establish that the content is
safe. Stage does not move or retain the upload, inspect its contents, or trust
its MIME type.
The application owns access checks, content validation, generated storage
names, quotas, and retention. PHP removes an unmoved temporary upload when
the request ends.

PHP receives multipart data before Stage handles the request. Configure
`upload_max_filesize`, a larger `post_max_size`, the temporary directory,
server limits, and timeouts. PHP's `M` settings use powers of 1024. Stage's
`maxBytes` argument is an exact byte count.

If the complete POST exceeds `post_max_size`, PHP can leave both `$_POST`
and `$_FILES` empty. Stage then sees a missing file and returns 400. A server
or application adapter must enforce the total request limit to return 413
for that case.

## Send a file

`new FileResponse($authorizedPath, $displayName)` opens a regular file and
sends it as an attachment in chunks of at most 64 KiB. Its `body` is empty,
because the file is not buffered there. Preserve the original response;
reconstructing it from `body` loses the file. HEAD sends headers without bytes.

`FileResponse::inline($authorizedPath, $displayName, $contentType, $request)`
adds inline display and one byte range. A satisfiable range returns 206.
An unsatisfiable range returns 416 with an empty body. Malformed or multiple
ranges return the full file with 200. `If-Range` also falls back to 200.
HEAD ignores Range. Attachment downloads do not process Range.

Stage checks the syntax of the inline content type, not whether it matches
the file. The application must authorize access and choose a safe media type.
Output buffering, compression, concurrent file changes, and storage failures
can affect delivery.
These helpers do not establish production throughput or a storage service.

## Sources

- [File transfer guide](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/docs/files.md)
- [File response implementation](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/FileResponse.php)
- [Upload implementation](https://github.com/skyyware/stage/blob/52adc61b10e72ce65a5d0c8fd2bd8242dc831f3b/src/Http/UploadedFile.php)
