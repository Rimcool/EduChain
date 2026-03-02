<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Portal - EduChain</title>
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
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        
        header { padding: 24px 0; border-bottom: 1px solid var(--border); }
        .header-inner { display: flex; align-items: center; justify-content: space-between; }
        .logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 24px; color: var(--green); }
        .nav-links { display: flex; gap: 24px; }
        .nav-links a { color: var(--text-2); text-decoration: none; font-weight: 500; transition: color 0.3s; }
        .nav-links a:hover { color: var(--text); }
        .btn { padding: 10px 20px; border-radius: 8px; border: 1px solid var(--border); background: var(--surface); color: var(--text); cursor: pointer; font-weight: 600; transition: all 0.3s; text-decoration: none; display: inline-block; }
        .btn:hover { border-color: var(--green); color: var(--green); }
        .btn-primary { background: var(--green); color: #000; border: none; }
        .btn-primary:hover { filter: brightness(1.1); }

        .hero { padding: 40px 0; text-align: center; }
        .hero h1 { font-family: 'Syne', sans-serif; font-size: 32px; margin: 0 0 8px; }
        .hero p { color: var(--text-2); margin: 0; }

        .content { padding: 40px 0; }
        .grid { display: grid; grid-template-columns: 1fr 1fr; gap: 24px; }
        
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 24px; }
        .card h2 { margin: 0 0 16px; font-size: 20px; }
        
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-size: 12px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 8px; }
        .form-group input { width: 100%; padding: 12px; border-radius: 8px; border: 1px solid var(--border); background: #0d1220; color: var(--text); font-size: 14px; }
        .form-group input:focus { outline: none; border-color: var(--blue); }
        
        .degrees-table { width: 100%; border-collapse: collapse; }
        .degrees-table th, .degrees-table td { padding: 12px; text-align: left; border-bottom: 1px solid var(--border); }
        .degrees-table th { color: var(--text-2); font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; }
        .degrees-table tr:last-child td { border-bottom: none; }
        .code { font-family: 'Space Mono', monospace; background: #0d1220; padding: 4px 8px; border-radius: 4px; border: 1px solid var(--border); color: var(--text-2); font-size: 12px; }
        
        .logout { margin-left: auto; }
    </style>
</head>
<body>
    <header>
        <div class="container header-inner">
            <div class="logo">EduChain</div>
            <nav class="nav-links">
                <a href="/portal">Portal</a>
                <a href="/logout" class="btn logout">Logout</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>University Portal</h1>
            <p>Welcome, {{ auth()->user()->name }}. Issue and manage degrees for your university.</p>
        </div>
    </section>

    <section class="content">
        <div class="container">
            <div class="grid">
                <div class="card">
                    <h2>➕ Issue New Degree</h2>
                    <form id="issueForm">
                        <div class="form-group">
                            <label for="student_name">Student Name</label>
                            <input type="text" id="student_name" name="student_name" placeholder="e.g., Ahmed Ali Khan" required>
                        </div>
                        <div class="form-group">
                            <label for="roll_number">Roll Number</label>
                            <input type="text" id="roll_number" name="roll_number" placeholder="e.g., FA19-BCS-001" required>
                        </div>
                        <div class="form-group">
                            <label for="degree_title">Degree Title</label>
                            <input type="text" id="degree_title" name="degree_title" placeholder="e.g., Bachelor of Science in Computer Science" required>
                        </div>
                        <div class="form-group">
                            <label for="graduation_year">Graduation Year</label>
                            <input type="number" id="graduation_year" name="graduation_year" placeholder="e.g., 2023" min="1947" max="2026" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Issue Degree</button>
                        <div id="issueResult" style="margin-top: 16px; display: none;"></div>
                    </form>
                </div>
                
                <div class="card">
                    <h2>📚 Issued Degrees</h2>
                    <table class="degrees-table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Degree</th>
                                <th>Year</th>
                                <th>Hash</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($degrees as $degree)
                            <tr>
                                <td>{{ $degree->student_name }}</td>
                                <td>{{ $degree->degree_title }}</td>
                                <td>{{ $degree->graduation_year }}</td>
                                <td><span class="code">{{ substr($degree->degree_hash, 0, 16) }}...</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('issueForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());
            
            const resultDiv = document.getElementById('issueResult');
            resultDiv.style.display = 'block';
            resultDiv.innerHTML = '<p style="color: var(--text-2);">Issuing degree...</p>';
            
            try {
                const res = await fetch('/portal/issue', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await res.json();
                
                if (result.success) {
                    resultDiv.innerHTML = `
                        <p style="color: var(--green);">✅ Degree issued successfully!</p>
                        <p style="color: var(--text-2); font-size: 12px;">Hash: ${result.hash}</p>
                    `;
                    // Refresh the page to show new degree
                    setTimeout(() => location.reload(), 1000);
                } else {
                    resultDiv.innerHTML = '<p style="color: var(--red);">❌ Failed to issue degree.</p>';
                }
                
            } catch (err) {
                resultDiv.innerHTML = '<p style="color: var(--red);">Error: ' + err.message + '</p>';
            }
        });
    </script>
</body>
</html>