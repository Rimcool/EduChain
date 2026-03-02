<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification Result - EduChain</title>
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
        .container { max-width: 800px; margin: 40px auto; padding: 0 20px; }
        
        .card { background: var(--surface); border: 1px solid var(--border); border-radius: 16px; padding: 32px; }
        .header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; }
        .logo { font-family: 'Syne', sans-serif; font-weight: 800; font-size: 24px; color: var(--green); }
        .status-badge { padding: 6px 12px; border-radius: 999px; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 0.05em; }
        .status-real { background: rgba(0, 255, 136, 0.15); color: var(--green); border: 1px solid rgba(0, 255, 136, 0.3); }
        .status-fake { background: rgba(255, 77, 106, 0.15); color: var(--red); border: 1px solid rgba(255, 77, 106, 0.3); }
        .status-unconfirmed { background: rgba(255, 185, 64, 0.15); color: var(--amber); border: 1px solid rgba(255, 185, 64, 0.3); }
        
        .details { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 24px; }
        .detail-item { background: #0d1220; padding: 16px; border-radius: 8px; border: 1px solid var(--border); }
        .detail-label { font-size: 12px; color: var(--text-3); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 4px; }
        .detail-value { font-weight: 600; }
        
        .score { font-size: 32px; font-weight: 800; margin-bottom: 16px; }
        .reason { color: var(--text-2); margin-bottom: 24px; line-height: 1.6; }
        
        .layers { display: grid; gap: 12px; margin-bottom: 24px; }
        .layer { display: flex; align-items: center; justify-content: space-between; padding: 12px; background: #0d1220; border-radius: 8px; border: 1px solid var(--border); }
        .layer.pass { border-color: rgba(0, 255, 136, 0.3); }
        .layer.fail { border-color: rgba(255, 77, 106, 0.3); }
        .layer.msg { color: var(--text-2); font-size: 14px; }
        .layer.grade { font-weight: 800; font-size: 14px; }
        
        .code { font-family: 'Space Mono', monospace; background: #0d1220; padding: 8px 12px; border-radius: 6px; border: 1px solid var(--border); color: var(--text-2); display: inline-block; margin-bottom: 16px; }
        
        .actions { display: flex; gap: 12px; flex-wrap: wrap; }
        .btn { padding: 10px 20px; border-radius: 8px; border: 1px solid var(--border); background: var(--surface); color: var(--text); cursor: pointer; font-weight: 600; transition: all 0.3s; text-decoration: none; display: inline-block; }
        .btn:hover { border-color: var(--green); color: var(--green); }
        .btn-primary { background: var(--green); color: #000; border: none; }
        .btn-primary:hover { filter: brightness(1.1); }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="header">
                <div class="logo">EduChain</div>
                <span class="status-badge {{ $v->result === 'real' ? 'status-real' : ($v->result === 'fake' ? 'status-fake' : 'status-unconfirmed') }}">{{ strtoupper($v->result) }}</span>
            </div>
            
            <div class="score">{{ $v->score }}%</div>
            <div class="reason">{{ $v->reason }}</div>
            
            <div class="details">
                <div class="detail-item">
                    <div class="detail-label">Student Name</div>
                    <div class="detail-value">{{ $v->student_name }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Roll Number</div>
                    <div class="detail-value">{{ $v->roll_number }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Degree Title</div>
                    <div class="detail-value">{{ $v->degree_title }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">University</div>
                    <div class="detail-value">{{ $v->university_name }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Graduation Year</div>
                    <div class="detail-value">{{ $v->graduation_year }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Verification Code</div>
                    <div class="detail-value"><span class="code">{{ $v->code }}</span></div>
                </div>
            </div>
            
            <div class="layers">
                @foreach(json_decode($v->checks, true) as $layer)
                    <div class="layer {{ $layer['pass'] ? 'pass' : 'fail' }}">
                        <span class="msg">{{ $layer['msg'] }}</span>
                        <span class="grade">{{ $layer['grade'] }}</span>
                    </div>
                @endforeach
            </div>
            
            <div class="actions">
                <a href="/" class="btn btn-primary">Verify Another Degree</a>
                <a href="/login" class="btn">Login to Save Results</a>
            </div>
        </div>
    </div>
</body>
</html>