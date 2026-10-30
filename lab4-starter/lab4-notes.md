# Lab 4: Guided Application Walkthrough and Testing

Repository: https://github.com/QingtianShi/IS6465-090-Fall

Codespace used: https://refactored-eureka-4qq4v466v9g93p7g.github.dev/

The Lab 4 project is in the `lab4-starter` folder. The supplied PHP files were left unchanged. The application was tested in Codespaces on October 30, 2026, using PHP 7.4.33 with the mbstring extension. From the repository root, the server was started with `php -S 0.0.0.0:8000`, and the application was opened at `/lab4-starter/request-form.php` through the forwarded port.

## Part 1: Run the application

A valid tutoring request was submitted with course `IS 6465`, preferred date `2026-11-15`, reason `I need help understanding PHP arrays.`, topic `Practice problems`, and preferred time `Afternoon`. The hidden `form_name` value was `tutoring_request`.

The browser sent the form values to `process-request.php` using POST. The application displayed the heading `Request received`, followed by the course, request details, selected topic, and `Status: Pending review`. The confirmation did not display the preferred date or time, even though those values were submitted and validated. The processing page does not include the shared templates, so its appearance is simpler than the form page.

This starter displays a confirmation but does not save the submitted request to a database. The request list still contains its three hard-coded sample records.

![Confirmation of a valid tutoring request](screenshots/valid-request.png)

## Part 2: Trace the templates

1. `includes/header.php` supplies the HTML doctype, the opening HTML element with English as its language, the head section, UTF-8 encoding, viewport settings, stylesheet links, the page title `Peer Tutoring Hub`, and the opening body tag. It establishes the common document structure rather than providing the navigation itself.
2. `includes/nav.php` supplies the shared navigation bar. It contains the `Peer Tutoring Hub` brand link to `index.php`, a `Requests` link to `requests.php`, and a `Request a Session` link to `request-form.php`.
3. `includes/footer.php` supplies the footer text `Peer Tutoring Hub`, loads the Bootstrap JavaScript bundle, and closes the body and HTML elements.
4. `require_once` is appropriate because these templates are required parts of the page and should be included only once during a request. It prevents duplicate markup if the same template is requested again, and PHP stops execution if a required file cannot be loaded.
5. The shared application stylesheet is linked in `includes/header.php` with `<link rel="stylesheet" href="css/styles.css">`. The same header also links Bootstrap 5.3.3 CSS from jsDelivr. The form requires the header and navigation at the top and the footer at the bottom.

## Part 3: Observe the form controls

| Control | Purpose and value received by PHP |
| --- | --- |
| `reason` | The textarea lets a student describe the help needed. PHP receives a single string in `$_POST['reason']`. The processor trims leading and trailing whitespace and requires the resulting text to contain 10 to 500 characters. |
| `topics[]` | The checkboxes allow multiple topics to be selected. PHP receives an array of selected strings in `$_POST['topics']`, such as `['Exam review', 'Study plan']`. The brackets make the submitted field an array; they are not part of the PHP key. Unchecked checkboxes are not submitted. If none are checked, the processor uses an empty array and rejects the request. |
| `preferredtime` | The radio buttons allow one choice from `Morning`, `Afternoon`, or `Evening`. PHP receives one string in `$_POST['preferredtime']` because the buttons share the same name. |
| `preferreddate` | The date input selects a preferred session date. PHP receives a string in `YYYY-MM-DD` format in `$_POST['preferreddate']`, rather than a PHP date object. The processor parses and validates the string and rejects dates before the server's current date. |
| `form_name` | The hidden input sends the string `tutoring_request` in `$_POST['form_name']`. The processor checks this identifier to recognize the expected form. A hidden input can still be altered by a client, so this check is not authentication or CSRF protection. |

## Part 4: Test validation behavior

All three tests were submitted through the actual form in Codespaces. Each used course `IS 6465`, reason `I need help understanding PHP arrays.`, preferred time `Afternoon`, and the automatically submitted hidden value `tutoring_request`.

| Test | Values entered | Observed outcome and application message | Business rule checked |
| --- | --- | --- | --- |
| Valid request | The preferred date was `2026-11-15`, and `Practice problems` was checked. | The request was accepted. The page displayed `Request received`, `Course: IS 6465`, `Request details: I need help understanding PHP arrays.`, `Topics: Practice problems`, and `Status: Pending review`. | A request must include an allowed course and time, a reason containing 10 to 500 characters, at least one allowed topic, a valid date that is today or later, and the expected form identifier. |
| Missing required value | The preferred date was `2026-11-15`, but no topics were checked. All other values matched the valid request. | The request was rejected. The page displayed `Request could not be submitted` and `Select at least one valid topic.` | At least one allowed topic must be selected. |
| Past date | The preferred date was `2026-10-01`, and `Practice problems` was checked. All other values matched the valid request. | The request was rejected. The page displayed `Request could not be submitted` and `Preferred date cannot be in the past.` | The preferred date cannot be earlier than the server's current date. |

The missing-topics test reached the server because the topic checkboxes do not have an HTML `required` attribute. The date input also has no HTML `min` attribute, so the past-date test reached the server. These results demonstrate server-side validation rather than only browser validation. The processor sets HTTP status 400 for validation errors.

## Part 5: Review testing and CRUD pages

### Validation test results

Opening `tests/validation-tests.php` produced the following results. All ten test cases passed.

| Test case | Result shown |
| --- | --- |
| Valid time | PASS |
| Missing time | PASS |
| Altered value | PASS |
| Multiple valid topics | PASS |
| Missing topics | PASS |
| Altered topic | PASS |
| Minimum length | PASS |
| Maximum length | PASS |
| Too short | PASS |
| Too long | PASS |

The test page calls the helper functions in `includes/validation.php` and compares their return values with expected values. It does not test the complete form submission or the preferred-date rule. The manual form submissions in Part 4 exercise `process-request.php`, which contains its own validation logic.

### CRUD page mapping

The request list displayed three sample requests with IDs 12, 13, and 14. Selecting `View` for request 12 opened its details page and showed its course, request details, date, time, topics, and status.

| CRUD action | Page |
| --- | --- |
| Create | `request-form.php` represents creating a request; it submits to `process-request.php` for validation and confirmation. |
| Read one request | `request-details.php?request_id=12` displays one matching sample request. |
| Read all requests | `requests.php` displays the sample request list. |
| Update | `edit-request.php` represents editing a request. |
| Delete | `delete-request.php` represents the cancellation confirmation for a request. |

These pages represent the CRUD interface, but they do not implement persistent database changes. The edit page uses fixed sample data and a form action of `#`. The delete page is also a preview with a form action of `#`.

### GET query parameters

1. The query parameter in the details URL is `request_id`. For example, `request-details.php?request_id=12` identifies request 12. The details page reads it with `filter_input(INPUT_GET, 'request_id', FILTER_VALIDATE_INT)`, checks that it is a positive integer, and searches the sample array for the matching request.
2. GET is appropriate because viewing a request retrieves information without changing stored data. Including the identifier in the URL also makes the details view linkable and bookmarkable. The identifier selects the request; it does not grant permission to access it.
3. An actual update or delete should use POST rather than GET because it changes application state. Following, prefetching, or revisiting a normal GET link should not modify or delete a record. A complete implementation should also validate the request and enforce authorization and CSRF protection; POST alone does not provide those protections.
