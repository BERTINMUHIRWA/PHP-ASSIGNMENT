# PHP-ASSIGNMENT
Individual Assignment
### Login Page
![Login Page](SCREENSHOT/login.png)

### Dashboard
![Dashboard](SCREENSHOT/dashboard.png)

### View Users
![View Users](SCREENSHOT/Users.png)

### Session and cookie store
![Session and cookie store](SCREENSHOT\sessions.png)

### Update user
![Update User](SCREENSHOT/Update.png)

### Sign up
![Signups](SCREENSHOT/register.png)

Brief documentation about sessions cookies and authentications
______________________________________________________________

1. How Sessions Were Used

    * Sessions are used to track logged-in users across pages.

    * When a user logs in, a session variable ($_SESSION['username']) is created.

    * Every protected page checks this session to ensure the user is authenticated.

    * Logging out destroys the session, preventing further access.

2. How Cookies Were Used

    * Cookies implement the “Remember Me” feature.

    * When a user selects “Remember Me” during login, a secure random token is generated and stored in both the database and as a cookie in the browser.

    * On subsequent visits, if the session has expired, the cookie token is validated against the database to log the user in automatically.

    * Cookies use HttpOnly and Secure flags to improve security.

3. How Authentication Is Secured

    * Passwords are stored encrypted in the database using md5() (or password_hash() for stronger security).

    * During login, the input password is encrypted to match the stored password.

    * Sessions prevent unauthorized access to protected pages.

    * Cookies store random tokens instead of plain passwords.

    * Logout clears both the session and cookie to prevent unauthorized reuse.