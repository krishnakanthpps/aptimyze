<!DOCTYPE html>
<html>
<head>

</head>
<body class="body" style="background:#eef0f1;padding:10px 40px 20px 40px;font-family: 'Open Sans',sans-serif;">
<div style="background:white;border-radius:10px;padding:0px 0px;margin:0px">
    <div style="text-align:center;width:100%;height:auto;background:#202e54;padding:0;margin-top:0px;border-top:1px;border-top-right-radius:10px;border-top-left-radius:10px;">
        <h1 style="color:#fff;padding:20px;">
            Aptimyze
        </h1>
    </div>
    <div style="padding:0px 40px">
        <h1 style="font-size:150%; color:#000;">
            Dear {{$name}},
        </h1>
        <p style="color:#000;">
            You have submitted your email for subscription to updates on  <a href="{{URL::to('/')}}"> {{url('/')}}</a>
        </p>
        <div style="background:#FAFDFE;border:2px solid #1E2C4F;display:inline-block;min-width:100%;overflow:hidden;border-radius:10px;">
            <div style="background:#1E2C4F;padding:10px 5px; color:white">
            </div>
            <div style="max-width:100%;padding:1.6% 2% 5% 2%;">
                Thank you for showing interest in aptimyze.
                Till then feel free to explore our site.
            </div>
        </div>
    </div>
    <div style="padding:1px 30px 1px 30px;background:#17223E;color:white;border-bottom-left-radius:10px;border-bottom-right-radius:10px;margin-top:30px">
        <p style="margin-bottom:2px">
            For any further queries, reach out to us at: <a style="color:white" href="mailto:support@aptimyze.com">support@aptimyze.com</a>
        </p>
        <p style="text-align:center; color:#fff;margin-top:0px">
            &copy; {{ date('Y') }}. Aptimyze
        </p>
    </div>
</div>
</body>
</html>
