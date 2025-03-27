<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Oceanic')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --sage: #9A9B87;
            --sage-dark: #7F8070;
            --linen: #DBD0C5;
            --blush: #E4C6BD;
            --taupe: #AD8E85;
            --cream: #F5F1EC;
            --charcoal: #333333;
        }
        
        body {
            background-color: var(--cream);
            font-family: 'Inter', sans-serif;
            color: var(--charcoal);
            line-height: 1.6;
        }
        
        .navbar {
            height: 80px;
            border-bottom: 1px solid var(--linen);
        }
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1.75rem;
            color: var(--charcoal) !important;
        }
        
        .btn-primary {
            background-color: var(--sage);
            border-color: var(--sage);
            padding: 0.5rem 1.25rem;
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--sage-dark);
            border-color: var(--sage-dark);
            transform: translateY(-1px);
        }
        
        .post-card {
            background: white;
            border: 1px solid var(--linen);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 1px 3px rgba(173, 142, 133, 0.05);
            transition: all 0.3s ease;
        }
        
        .post-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px -5px rgba(173, 142, 133, 0.1);
        }
        
        .post-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--charcoal);
            margin-bottom: 0.5rem;
        }
        
        .post-content {
            color: var(--taupe);
            margin-bottom: 1.25rem;
            line-height: 1.5;
        }
        
        .post-meta {
            font-size: 0.75rem;
            color: var(--taupe);
            padding-top: 1rem;
            border-top: 1px solid var(--linen);
        }
        
        .post-status {
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
        }
        
        .status-published {
            background-color: rgba(154, 155, 135, 0.1);
            color: var(--sage);
        }
        
        .status-draft {
            background-color: rgba(233, 196, 189, 0.1);
            color: var(--taupe);
        }
        
        .post-date {
            font-size: 0.75rem;
            background-color: var(--cream);
            color: var(--taupe);
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
        }
        
        .dropdown-menu {
            min-width: 14rem;
            border: 1px solid var(--linen);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            padding: 0;
        }
        
        .dropdown-item {
            padding: 0.75rem 1.5rem;
        }
        
        .dropdown-header {
            padding: 0.75rem 1.5rem;
            border-bottom: 1px solid var(--linen);
        }
        
        .avatar {
            width: 32px;
            height: 32px;
            border: 1px solid var(--blush);
        }
        
        footer {
            border-top: 1px solid var(--linen);
            padding: 3rem 0;
        }
        
        .footer-title {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1.125rem;
            margin-bottom: 1rem;
        }
        
        .footer-link {
            color: var(--taupe);
            text-decoration: none;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .footer-link:hover {
            color: var(--sage);
        }
    </style>
    @stack('styles')
</head>
<body>
    <header class="bg-white">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{ route('home') }}">Oceanic</a>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto align-items-center">
                            @auth
                            <li class="nav-item me-3">
                                <a href="{{ route('posts.create') }}" class="btn btn-primary d-flex align-items-center">
                                    <i class="bi bi-plus-lg me-1"></i>
                                    New Post
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    @if(auth()->user()->avatar)
                                    <img src="{{ auth()->user()->avatar_url }}" 
                                         alt="Profile" 
                                         class="avatar rounded-circle me-2"
                                         onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                                    @else
                                    <div class="avatar rounded-circle d-flex align-items-center justify-content-center me-2" style="background: var(--cream)">
                                        <i class="bi bi-person" style="color: var(--taupe)"></i>
                                    </div>
                                    @endif
                                    {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <div class="dropdown-header">
                                            <h6 class="mb-0">{{ auth()->user()->name }}</h6>
                                            <small class="text-muted">{{ auth()->user()->email }}</small>
                                        </div>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('posts.user') }}">
                                        <i class="bi bi-file-text me-2"></i>My Posts
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="bi bi-box-arrow-right me-2"></i>Sign Out
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}" style="color: var(--taupe)">Sign in</a>
                            </li>
                            <li class="nav-item ms-2">
                                <a class="btn btn-primary" href="{{ route('register') }}">Get started</a>
                            </li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    
    <main class="container py-5">
        @yield('content')
    </main>
    
    <footer class="bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5 class="footer-title">Oceanic</h5>
                    <p class="text-muted small">A minimalist publishing platform for thoughtful creators.</p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h6 class="text-uppercase small mb-3" style="color: var(--charcoal)">Product</h6>
                    <a href="#" class="footer-link">Features</a>
                    <a href="#" class="footer-link">Pricing</a>
                    <a href="#" class="footer-link">API</a>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h6 class="text-uppercase small mb-3" style="color: var(--charcoal)">Resources</h6>
                    <a href="#" class="footer-link">Documentation</a>
                    <a href="#" class="footer-link">Guides</a>
                    <a href="#" class="footer-link">Blog</a>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h6 class="text-uppercase small mb-3" style="color: var(--charcoal)">Company</h6>
                    <a href="#" class="footer-link">About</a>
                    <a href="#" class="footer-link">Careers</a>
                    <a href="#" class="footer-link">Contact</a>
                </div>
            </div>
            <div class="text-center pt-4 mt-4" style="border-top: 1px solid var(--linen)">
                <p class="text-muted small mb-0">&copy; {{ date('Y') }} Oceanic. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>