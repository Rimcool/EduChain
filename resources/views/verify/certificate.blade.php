<!DOCTYPE html>
<html>
<head>
    <title>EduChain Verification Certificate</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .certificate { width: 210mm; height: 297mm; margin: 0 auto; padding: 30mm; box-sizing: border-box; position: relative; }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: bold; color: #22c55e; margin-bottom: 10px; }
        .title { font-size: 18px; color: #666; margin-bottom: 30px; }
        .content { background: #f8fafc; padding: 30px; border-radius: 8px; }
        .result-box { text-align: center; margin-bottom: 30px; }
        .status { font-size: 32px; font-weight: bold; margin-bottom: 10px; }
        .real { color: #16a34a; }
        .fake { color: #dc2626; }
        .unconfirmed { color: #f59e0b; }
        .details { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px; }
        .detail-box { background: white; padding: 20px; border-radius: 4px; }
        .detail-box h4 { margin: 0 0 10px 0; color: #666; font-size: 12px; text-transform: uppercase; }
        .detail-box p { margin: 0; font-size: 16px; }
        .layers { background: white; padding: 20px; border-radius: 4px; margin-bottom: 30px; }
        .layers h4 { margin: 0 0 15px 0; color: #666; font-size: 12px; text-transform: uppercase; }
        .layer-item { display: flex; justify-content: space-between; margin-bottom: 8px; border-bottom: 1px solid #eee; padding-bottom: 8px; }
        .footer { text-align: center; margin-top: 30px; color: #666; font-size: 12px; }
        .qr-code { text-align: center; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="header">
            <div class="logo">EduChain</div>
            <div class="title">Degree Verification Certificate</div>
        </div>

        <div class="content">
            <div class="result-box">
                @php
                    $statusClass = '';
                    $statusText = '';
                    
                    switch($verification->result) {
                        case 'real':
                            $statusClass = 'real';
                            $statusText = 'VERIFIED';
                            break;
                        case 'fake':
                            $statusClass = 'fake';
                            $statusText = 'FAKE';
                            break;
                        case 'unconfirmed':
                            $statusClass = 'unconfirmed';
                            $statusText = 'UNCONFIRMED';
                            break;
                    }
                @endphp
                
                <div class="status {{ $statusClass }}">{{ $statusText }}</div>
                <p>Verification Score: {{ $verification->score }}/100</p>
                <p>Verified on: {{ $verification->created_at->format('F j, Y') }}</p>
            </div>

            <div class="details">
                <div class="detail-box">
                    <h4>Student Information</h4>
                    <p><strong>Name:</strong> {{ $verification->student_name }}</p>
                    <p><strong>Roll Number:</strong> {{ $verification->roll_number }}</p>
                    <p><strong>Degree:</strong> {{ $verification->degree_title }}</p>
                    <p><strong>University:</strong> {{ $verification->university_name }}</p>
                    <p><strong>Year:</strong> {{ $verification->graduation_year }}</p>
                </div>
                
                <div class="detail-box">
                    <h4>Verification Details</h4>
                    <p><strong>Reason:</strong> {{ $verification->reason }}</p>
                    <p><strong>Hash:</strong> {{ $verification->degree_hash }}</p>
                    <p><strong>Code:</strong> {{ $verification->code }}</p>
                    <p><strong>Transaction:</strong> {{ $verification->tx_hash ?? 'N/A' }}</p>
                </div>
            </div>

            <div class="layers">
                <h4>Verification Layers</h4>
                @php $layers = json_decode($verification->checks, true); @endphp
                @foreach($layers as $key => $value)
                    <div class="layer-item">
                        <span>{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                        <span style="color: {{ $value ? '#16a34a' : '#dc2626' }}">
                            {{ $value ? '✓' : '✗' }}
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="footer">
                <p>This certificate is valid and can be verified at {{ url('/check/' . $verification->code) }}</p>
                <p>Verification Code: {{ $verification->code }}</p>
            </div>

            <div class="qr-code">
                {!! QrCode::size(150)->generate(url('/check/' . $verification->code)) !!}
                <p style="margin-top: 10px; font-size: 10px;">Scan to verify</p>
            </div>
        </div>
    </div>
</body>
</html>