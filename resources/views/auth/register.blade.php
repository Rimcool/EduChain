<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - EduChain</title>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Syne:wght@400;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #080c14;
            --bg2: #0d1220;
            --surface: #161d2e;
            --border: #1e2d45;
            --green: #00ff88;
            --blue: #4d9eff;
            --red: #ff4d6a;
            --amber: #ffb940;
            --text: #e8f0fe;
            --text-2: #8899bb;
            --text-3: #445577;
        }

        * { box-sizing: border-box; }
        body { margin: 0; background: var(--bg); color: var(--text); font-family: 'DM Sans', sans-serif; }
        .container { max-width: 400px; margin: 100px auto; padding: 0 20px; }
        
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 32px; }
        .card h1 { margin: 0 0 8px; font-family: 'Syne', sans-serif; font-size: 28px; }
        .card p { color: var(--text-2); margin: 0 0 24px; }
        
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-size: 12px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; }
        .form-group input, .form-group select { width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border); background: #0d1220; color: var(--text); font-size: 14px; }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: var(--blue); }
        
        .btn { width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border); background: var(--green); color: #000; font-weight: 700; cursor: pointer; transition: all 0.3s; }
        .btn:hover { filter: brightness(1.1); }
        .btn.secondary { background: transparent; color: var(--text); border-color: var(--border); margin-top: 12px; }
        .btn.secondary:hover { border-color: var(--green); color: var(--green); }
        
        .links { text-align: center; margin-top: 16px; }
        .links a { color: var(--text-2); text-decoration: none; }
        .links a:hover { color: var(--text); }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>EduChain</h1>
            <p>Create your account</p>
            
            <form method="POST" action="/register">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required>
                        <option value="">Select role</option>
                        <option value="recruiter">Recruiter</option>
                        <option value="university">University</option>
                    </select>
                </div>
                <button type="submit" class="btn">Register</button>
            </form>
            
            <div class="links">
                <a href="/login">Already have an account? Sign In</a>
            </div>
        </div>
    </div>
</body>
</html>