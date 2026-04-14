<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CPA 2026 - UEAP')</title>
    <style>
        :root {
            --ueap-blue: #003e7e;
            --ueap-blue-dark: #002b58;
            --ueap-orange: #ef7d00;
            --ueap-red: #d32f2f;
            --ueap-bg: #f4f7fb;
            --ueap-text: #1a2433;
            --ueap-muted: #5d6d7e;
            --card: #ffffff;
            --border: #d7e1ec;
        }

        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: "Segoe UI", Roboto, Arial, sans-serif;
            background: linear-gradient(180deg, #edf3fa 0%, var(--ueap-bg) 180px);
            color: var(--ueap-text);
        }
        .topbar {
            background: var(--ueap-blue);
            color: #fff;
            padding: 12px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .topbar.admin {
            background: var(--ueap-red);
        }
        .topbar a { color: #fff; text-decoration: none; font-weight: 600; }
        .status { font-weight: normal; margin-left: 10px; }
        .container { max-width: 980px; margin: 24px auto 48px; padding: 0 16px; }
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 8px 26px rgba(0, 43, 88, .08);
            margin-bottom: 16px;
        }
        h1, h2, h3 { color: var(--ueap-blue-dark); margin-top: 0; }
        .muted { color: var(--ueap-muted); }
        .btn {
            display: inline-block;
            border: 0;
            border-radius: 8px;
            background: var(--ueap-blue);
            color: #fff;
            padding: 10px 14px;
            text-decoration: none;
            cursor: pointer;
            font-weight: 600;
        }
        .btn-secondary { background: var(--ueap-orange); }
        .btn-outline {
            background: #fff;
            color: var(--ueap-blue);
            border: 1px solid var(--ueap-blue);
        }
        .grid { display: grid; gap: 12px; }
        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); }
        input[type="text"], input[type="password"], textarea {
            width: 100%; padding: 10px; border: 1px solid #c8d4e3; border-radius: 8px;
        }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { border: 1px solid var(--border); padding: 10px; text-align: left; }
        .table th { background: #f0f5fb; }
        .question-card { padding: 14px; border: 1px solid var(--border); border-radius: 10px; margin: 10px 0; }
        .section-title { border-left: 5px solid var(--ueap-orange); padding-left: 10px; }
        .actions { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px; }
        .alert { background: #fff3f3; border: 1px solid #e6aaaa; color: #7b1f1f; padding: 10px; border-radius: 8px; }
        .alert-success { background: #f0f9f0; border: 1px solid #a3d9a3; color: #2d5a2d; padding: 10px; border-radius: 8px; }
        .progress-container { margin: 20px 0; }
        .progress-bar { width: 100%; height: 10px; background: var(--border); border-radius: 5px; overflow: hidden; }
        .progress-fill { height: 100%; background: var(--ueap-orange); width: 0%; transition: width 0.3s ease; }
        .progress-text { text-align: center; margin-top: 5px; font-size: 14px; color: var(--ueap-muted); }
        .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0,0,0,0); white-space: nowrap; border: 0; }
    </style>

    <style>
        @media (max-width: 768px) {
            .container { padding: 0 10px; }
            .card { padding: 15px; margin-bottom: 12px; }
            .question-card { padding: 10px; margin: 8px 0; }
            .actions { flex-direction: column; align-items: stretch; }
            .btn { width: 100%; margin-bottom: 5px; }
            .progress-text { font-size: 12px; }
            h1 { font-size: 1.5em; }
            h2 { font-size: 1.2em; }
        }
    </style>
</head>
<body>
    <header class="topbar @auth @if(auth()->user()->is_admin) admin @endif @endauth">
        <strong>Universidade do Estado do Amapá • CPA 2026</strong>
        @auth
            <span class="status">
                @if(auth()->user()->is_admin)
                    Admin
                @else
                    Respondendo o questionário
                @endif
            </span>
        @endauth
        <a href="{{ route('landing') }}">Início</a>
    </header>

    <main class="container">
        @if(session('warning'))
            <div class="alert" style="background: #fff3cd; border: 1px solid #ffc107; color: #856404; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
                {{ session('warning') }}
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
