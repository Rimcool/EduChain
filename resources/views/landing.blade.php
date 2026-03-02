<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduChain - Blockchain Degree Verification</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        
        /* Header */
        header { padding: 24px 0; border-bottom: 1px solid var(--border); }
        .header-inner { display: flex; align-items: center; justify-content: space-between; }
        .logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 24px; letter-spacing: 1px; color: var(--green); }
        .nav-links { display: flex; gap: 24px; }
        .nav-links a { color: var(--text-2); text-decoration: none; font-weight: 500; transition: color 0.3s; }
        .nav-links a:hover { color: var(--text); }
        .btn { padding: 10px 20px; border-radius: 8px; border: 1px solid var(--border); background: var(--surface); color: var(--text); cursor: pointer; font-weight: 600; transition: all 0.3s; }
        .btn:hover { border-color: var(--green); color: var(--green); }
        .btn-primary { background: var(--green); color: #000; border: none; }
        .btn-primary:hover { filter: brightness(1.1); }

        /* Hero */
        .hero { padding: 80px 0; text-align: center; }
        .hero h1 { font-family: 'Syne', sans-serif; font-size: 48px; margin: 0 0 16px; background: linear-gradient(90deg, var(--green), var(--blue)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero p { font-size: 18px; color: var(--text-2); max-width: 700px; margin: 0 auto 32px; }
        .hero-actions { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }
        
        /* Scanner UI */
        .scanner { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 24px; margin: 40px 0; }
        .scanner h2 { margin: 0 0 16px; font-size: 24px; }
        .form-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 16px; }
        .form-group { display: flex; flex-direction: column; gap: 8px; }
        .form-group label { font-size: 12px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.05em; }
        .form-group input, .form-group select { padding: 12px; border-radius: 8px; border: 1px solid var(--border); background: #0d1220; color: var(--text); font-size: 14px; }
        .form-group input:focus, .form-group select:focus { outline: none; border-color: var(--blue); }
        .scan-btn { width: 100%; margin-top: 16px; }
        
        /* Results */
        .result-card { display: none; background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 24px; margin-top: 24px; }
        .result-header { display: flex; align-items: center; gap: 16px; margin-bottom: 16px; }
        .status-badge { padding: 6px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; }
        .status-real { background: rgba(0, 255, 136, 0.15); color: var(--green); border: 1px solid rgba(0, 255, 136, 0.3); }
        .status-fake { background: rgba(255, 77, 106, 0.15); color: var(--red); border: 1px solid rgba(255, 77, 106, 0.3); }
        .status-unconfirmed { background: rgba(255, 185, 64, 0.15); color: var(--amber); border: 1px solid rgba(255, 185, 64, 0.3); }
        .score { font-size: 24px; font-weight: 800; }
        .reason { color: var(--text-2); margin-bottom: 16px; }
        .layers { display: grid; gap: 12px; }
        .layer { display: flex; align-items: center; justify-content: space-between; padding: 12px; background: #0d1220; border-radius: 8px; border: 1px solid var(--border); }
        .layer.pass { border-color: rgba(0, 255, 136, 0.3); }
        .layer.fail { border-color: rgba(255, 77, 106, 0.3); }
        .layer.msg { color: var(--text-2); font-size: 14px; }
        .layer.grade { font-weight: 800; font-size: 14px; }
        .code { font-family: 'Space Mono', monospace; background: #0d1220; padding: 8px 12px; border-radius: 6px; border: 1px solid var(--border); color: var(--text-2); }
        
        /* Footer */
        footer { padding: 40px 0; border-top: 1px solid var(--border); color: var(--text-2); font-size: 14px; text-align: center; }
    </style>
</head>
<body>
    <header>
        <div class="container header-inner">
            <div class="logo">EduChain</div>
            <nav class="nav-links">
                <a href="#scanner">Verify</a>
                <a href="/login">Login</a>
                <a href="/register">Register</a>
            </nav>
        </div>
    </header>

    <section class="hero">
        <div class="container">
            <h1>Instant Degree Verification</h1>
            <p>Verify any Pakistani degree in seconds using HEC database + blockchain records. Recruiters and universities can instantly confirm if a degree is real or fake.</p>
            <div class="hero-actions">
                <a href="#scanner" class="btn btn-primary">Verify a Degree</a>
                <a href="/register" class="btn">Join as Recruiter</a>
            </div>
        </div>
    </section>

    <section id="scanner" class="container">
        <div class="scanner">
            <h2>🔍 Degree Scanner</h2>
            <form id="verifyForm">
                <div class="form-grid">
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
                        <label for="university_name">University Name</label>
                        <input type="text" id="university_name" name="university_name" placeholder="e.g., COMSATS University, Islamabad" required>
                    </div>
                    <div class="form-group">
                        <label for="graduation_year">Graduation Year</label>
                        <input type="number" id="graduation_year" name="graduation_year" placeholder="e.g., 2023" min="1947" max="2026" required>
                    </div>
                </div>
                <button type="submit" class="btn scan-btn">Scan Degree</button>
            </form>

            <div id="resultCard" class="result-card">
                <div class="result-header">
                    <span id="statusBadge" class="status-badge">Status</span>
                    <span class="score" id="score">0%</span>
                </div>
                <div class="reason" id="reason">Reason</div>
                <div class="layers" id="layers"></div>
                <div style="margin-top:16px;">
                    <strong>Verification Code:</strong> <span class="code" id="code">EDU-XXXX</span>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>© 2026 EduChain. Built for Pakistan's education verification needs.</p>
        </div>
    </footer>

    <script>
        document.getElementById('verifyForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = Object.fromEntries(formData.entries());
            
            const resultCard = document.getElementById('resultCard');
            resultCard.style.display = 'block';
            
            // Show loading
            document.getElementById('statusBadge').textContent = 'Scanning...';
            document.getElementById('statusBadge').className = 'status-badge';
            document.getElementById('score').textContent = '...';
            document.getElementById('reason').textContent = 'Please wait...';
            document.getElementById('layers').innerHTML = '';
            
            try {
                const res = await fetch('/verify/check', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(data)
                });
                
                const result = await res.json();
                
                // Update UI
                const badge = document.getElementById('statusBadge');
                badge.textContent = result.result.toUpperCase();
                badge.classList.add(result.result === 'real' ? 'status-real' : result.result === 'fake' ? 'status-fake' : 'status-unconfirmed');
                
                document.getElementById('score').textContent = result.score + '%';
                document.getElementById('reason').textContent = result.reason;
                document.getElementById('code').textContent = result.code;
                
                // Render layers
                const layersContainer = document.getElementById('layers');
                layersContainer.innerHTML = '';
                result.layers.forEach(layer => {
                    const div = document.createElement('div');
                    div.className = 'layer ' + (layer.pass ? 'pass' : 'fail');
                    div.innerHTML = `
                        <span class="msg">${layer.msg}</span>
                        <span class="grade">${layer.grade}</span>
                    `;
                    layersContainer.appendChild(div);
                });
                
            } catch (err) {
                document.getElementById('reason').textContent = 'Error: ' + err.message;
            }
        });
    </script>
</body>
</html>