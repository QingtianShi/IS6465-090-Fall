AirAsia HW2 — Running, Testing, and Submitting

PROJECT FILES

airasia-hw2.zip contains the assignment source files. Extract it, then upload the contents of the airasia-hw2 folder to the root of your GitHub repository. Keep the css and images folders intact.

RUNNING THE WEBSITE

In GitHub Codespaces or a local terminal with PHP installed, run this command from the project root:

php -S 0.0.0.0:8000

Open the preview for port 8000, then visit /login.php. PHP is used only to serve the .php files; the pages themselves contain no PHP programming logic.

TESTING CHECKLIST

1. On the login page, enter any sample username and password. Click Login and confirm that the gift card list opens. Do not use a real password.
2. Confirm that the list displays three gift card images, names, and point requirements. Click a card image or name to open the details page. All cards intentionally link to the same Flight gift card details page, as permitted by the assignment.
3. Confirm that the details page shows the card image, name, type, value, and points required. Click Update gift card.
4. Confirm that all four update fields are prepopulated. Change a value and click Save changes. You should return to the list. Changes are not saved in this static prototype.
5. From the list, click Add gift card. Complete all four fields and submit. You should return to the list without adding a saved record.
6. Try submitting with required fields empty. The browser should block submission. Card value must be greater than zero, and points must be a positive whole number.
7. Test Cancel, Back, and Log out links. Narrow the browser window and check that text, images, and buttons remain readable without horizontal overflow.

BEFORE SUBMITTING

- Personally review the code and test the website. Update ai-use.txt with a truthful example of an AI suggestion you tested, changed, or rejected.
- Compare the website with your HW1 wireframes and the separate requirements document. These materials were not provided when this version was created.
- Commit and push all required pages, CSS, images, and ai-use.txt to GitHub.
- Confirm that the instructor can access your repository.
- Submit the GitHub repository link in Canvas.

The files have not yet been uploaded to GitHub or submitted to Canvas.
