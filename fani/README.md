# Valentine's Date Website - Deployment Guide

This is a cute Valentine's Day website asking Fani to plan your date! 🌹

## Files Included

- `index.html` - The main form page (cute Valentine's design)
- `submit.php` - Backend script to handle form submissions
- `admin.php` - Admin page to view responses
- `responses.json` - Storage file for responses (needs write permissions)
- `.htaccess` - URL rewriting rules (optional)

## Deployment Instructions

### Option 1: Deploy to Your Domain (laroshss.com/fani)

1. **Upload all files to your web server:**
   - Connect to your hosting via FTP, cPanel File Manager, or SSH
   - Navigate to your web root (usually `public_html/` or `www/`)
   - Create a folder called `fani/`
   - Upload all files into the `fani/` folder

2. **Set file permissions:**
   - Make sure `responses.json` has write permissions (chmod 644 or 666)
   - You can do this via FTP client or cPanel File Manager
   - Right-click the file → Permissions → Set to 644

3. **Test the setup:**
   - Visit `https://laroshss.com/fani/` to see the form
   - Submit a test response
   - Visit `https://laroshss.com/fani/admin.php` to view responses

### Option 2: Quick Test Locally

If you want to test locally first:

1. Install a local PHP server (XAMPP, MAMP, or use PHP's built-in server)
2. Place files in your server's web directory
3. Start the server
4. Visit `http://localhost/fani/` or `http://localhost:8000/`

Using PHP's built-in server:
```bash
cd /path/to/your/files
php -S localhost:8000
```

## File Structure

```
fani/
├── index.html          # Main form page
├── submit.php          # Form submission handler
├── admin.php           # View responses
├── responses.json      # Response storage (needs write permission!)
└── .htaccess          # URL rules (optional)
```

## Security Notes

⚠️ **IMPORTANT:** The admin.php page is publicly accessible! Anyone who knows the URL can view responses.

### To protect admin.php:

**Option 1: Password Protection via .htaccess**

Create a file called `.htpasswd` with a username and encrypted password:
```bash
# Generate password (use online tool or command line)
htpasswd -c .htpasswd parish
```

Then add this to `.htaccess`:
```apache
<Files "admin.php">
    AuthType Basic
    AuthName "Admin Access"
    AuthUserFile /full/path/to/.htpasswd
    Require valid-user
</Files>
```

**Option 2: Simple PHP Password Check**

Add this to the top of `admin.php` (after `<?php`):
```php
<?php
session_start();

// Simple password protection
$password = "your_secret_password_here";

if (!isset($_SESSION['logged_in'])) {
    if (isset($_POST['password']) && $_POST['password'] === $password) {
        $_SESSION['logged_in'] = true;
    } else {
        // Show login form
        if (isset($_POST['password'])) {
            echo "<p style='color:red'>Wrong password!</p>";
        }
        ?>
        <!DOCTYPE html>
        <html>
        <head><title>Login</title></head>
        <body>
            <form method="post">
                <input type="password" name="password" placeholder="Password">
                <button type="submit">Login</button>
            </form>
        </body>
        </html>
        <?php
        exit;
    }
}
?>
```

**Option 3: Rename admin.php**

Rename `admin.php` to something only you know, like `view_responses_secret123.php`

## Customization

### Change Colors
Edit the CSS variables in `index.html`:
```css
:root {
    --pink-light: #FFE5E5;
    --pink-medium: #FFB6C1;
    --pink-dark: #FF69B4;
    --red-accent: #FF1744;
}
```

### Add More Questions
1. Add a new question block in `index.html`
2. The form will automatically include it in submissions

## Troubleshooting

**Form submissions not saving?**
- Check that `responses.json` has write permissions (644 or 666)
- Make sure PHP is enabled on your server
- Check server error logs

**Can't access the page?**
- Verify files are in the correct directory
- Check that your domain is pointing to the right server
- Make sure `.htaccess` isn't blocking access

**Admin page shows "No responses yet"?**
- Submit a test response first
- Check that `submit.php` ran successfully
- Verify `responses.json` is writable

## Features

✨ Animated floating hearts background
✨ Smooth transitions and hover effects  
✨ Mobile-responsive design
✨ Auto-refresh on admin page (every 10 seconds)
✨ Beautiful pink/red Valentine's color scheme
✨ Custom fonts (Pacifico + Quicksand)

## Need Help?

If you run into issues:
1. Check your hosting's PHP error logs
2. Make sure PHP version is 7.0 or higher
3. Verify file permissions are correct
4. Test locally first if possible

---

Made with ♡ for Fani
