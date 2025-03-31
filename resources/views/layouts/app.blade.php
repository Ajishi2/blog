
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Oceanic')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Bootstrap theme colors */
            --bs-primary: #3b82f6;
            --bs-primary-rgb: 59, 130, 246;
            --bs-primary-dark: #2563eb;
            --bs-secondary: #64748b;
            --bs-secondary-rgb: 100, 116, 139;
            --bs-secondary-dark: #475569;
            --bs-success: #10b981;
            --bs-success-rgb: 16, 185, 129;
            --bs-info: #06b6d4;
            --bs-info-rgb: 6, 182, 212;
            --bs-warning: #f59e0b;
            --bs-warning-rgb: 245, 158, 11;
            --bs-danger: #ef4444;
            --bs-danger-rgb: 239, 68, 68;
            --bs-light: #f8fafc;
            --bs-light-rgb: 248, 250, 252;
            --bs-dark: #1e293b;
            --bs-dark-rgb: 30, 41, 59;
            
            /* Custom colors */
            --oceanic-blue-50: #eff6ff;
            --oceanic-blue-100: #dbeafe;
            --oceanic-blue-200: #bfdbfe;
            --oceanic-blue-300: #93c5fd;
            --oceanic-blue-400: #60a5fa;
            --oceanic-blue-500: #3b82f6;
            --oceanic-blue-600: #2563eb;
            --oceanic-blue-700: #1d4ed8;
            --oceanic-blue-800: #1e40af;
            --oceanic-blue-900: #1e3a8a;
            
            --oceanic-gray-50: #f8fafc;
            --oceanic-gray-100: #f1f5f9;
            --oceanic-gray-200: #e2e8f0;
            --oceanic-gray-300: #cbd5e1;
            --oceanic-gray-400: #94a3b8;
            --oceanic-gray-500: #64748b;
            --oceanic-gray-600: #475569;
            --oceanic-gray-700: #334155;
            --oceanic-gray-800: #1e293b;
            --oceanic-gray-900: #0f172a;
            
            /* Border radius */
            --bs-border-radius: 0.5rem;
            --bs-border-radius-sm: 0.375rem;
            --bs-border-radius-lg: 0.75rem;
            --bs-border-radius-xl: 1rem;
            --bs-border-radius-2xl: 1.5rem;
            --bs-border-radius-pill: 50rem;
        }
        .post-card, .form-card {
    border-radius: 0.75rem !important;
    border: none !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12) !important;
    transition: all 0.3s ease;
    overflow: hidden;
    margin-bottom: 8rem;
    background: white;
}.card-body {
    padding: 3rem !important;
}
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--oceanic-gray-50);
            color: var(--oceanic-gray-800);
            min-height: 100vh;
        }
        
        /* Typography */
        .font-serif {
            font-family: 'Playfair Display', serif;
        }
        
        h1, h2, h3, h4, h5, h6 {
            color: var(--oceanic-gray-800);
        }
        
        .text-muted {
            color: var(--oceanic-gray-500) !important;
        }
        
        /* Buttons */
        .btn-primary {
            background-color: var(--bs-primary);
            border-color: var(--bs-primary);
            color: white;
            transition: all 0.3s ease;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            border-radius: var(--bs-border-radius);
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--bs-primary-dark);
            border-color: var(--bs-primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
        }
        .navbar {
    z-index: 1030; /* Bootstrap's default z-index for fixed elements */
    position: relative; /* or 'fixed' if you want it to stay at top on scroll */
}
        .btn-secondary {
            background-color: var(--bs-secondary);
            border-color: var(--bs-secondary);
            color: white;
            transition: all 0.3s ease;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            border-radius: var(--bs-border-radius);
        }
        
        .btn-secondary:hover, .btn-secondary:focus {
            background-color: var(--bs-secondary-dark);
            border-color: var(--bs-secondary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(100, 116, 139, 0.25);
        }
        
        .btn-outline-primary {
            border-color: var(--bs-primary);
            color: var(--bs-primary);
            transition: all 0.3s ease;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            border-radius: var(--bs-border-radius);
        }
        
        .btn-outline-primary:hover, .btn-outline-primary:focus {
            background-color: var(--bs-primary);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
        }
        
        .btn-link {
            color: var(--bs-primary);
            text-decoration: none;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-link:hover, .btn-link:focus {
            color: var(--bs-primary-dark);
        }
        
        /* Cards */
        .card {
            border-radius: var(--bs-border-radius-lg);
            border-color: var(--oceanic-gray-200);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            overflow: hidden;
        }
        
        .card:hover {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background-color: white;
            border-bottom-color: var(--oceanic-gray-200);
            padding: 1.25rem 1.5rem;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .card-footer {
            background-color: white;
            border-top-color: var(--oceanic-gray-200);
            padding: 1.25rem 1.5rem;
        }
        
        /* Forms */
        .form-control, .form-select {
            border-color: var(--oceanic-gray-300);
            border-radius: var(--bs-border-radius);
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--bs-primary);
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.15);
        }
        
        .form-label {
            color: var(--oceanic-gray-700);
            font-weight: 500;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }
        
        /* Badges */
        .badge {
            font-weight: 500;
            padding: 0.35em 0.85em;
            border-radius: var(--bs-border-radius-pill);
        }
        
        /* Alerts */
        .alert {
            border-radius: var(--bs-border-radius);
            border: none;
            padding: 1rem 1.25rem;
        }
        
        .alert-success {
            background-color: rgba(16, 185, 129, 0.15);
            color: #047857;
        }
        
        /* Navbar */
        .navbar {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1030;
    background-color: white;
    border-bottom: 1px solid var(--oceanic-gray-200);
    padding: 1rem 0;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}
        
        .navbar-brand {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            font-size: 1.5rem;
            color: var(--bs-primary);
        }
        
        /* Dropdown */
        .dropdown-menu {
            border-radius: var(--bs-border-radius);
            border-color: var(--oceanic-gray-200);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            padding: 0.5rem 0;
            min-width: 14rem;
        }
        
        .dropdown-header {
            padding: 0.75rem 1.25rem;
            color: var(--oceanic-gray-800);
            font-weight: 500;
            border-bottom: 1px solid var(--oceanic-gray-200);
        }
        
        .dropdown-item {
            padding: 0.6rem 1.25rem;
            color: var(--oceanic-gray-600);
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover, .dropdown-item:focus {
            background-color: var(--oceanic-gray-100);
            color: var(--oceanic-gray-800);
        }
        
        .dropdown-item.active, .dropdown-item:active {
            background-color: var(--bs-primary);
            color: white;
        }
        
        .dropdown-divider {
            border-top-color: var(--oceanic-gray-200);
            margin: 0.25rem 0;
        }
        
        /* Footer */
        footer {
            background-color: white;
            border-top: 1px solid var(--oceanic-gray-200);
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }
        
        footer h4 {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 1.25rem;
            color: var(--oceanic-gray-500);
        }
        .card {
    border-radius: 0.75rem !important;
    overflow: hidden;
    transition: all 0.3s ease;
}

.shadow-sm {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12) !important;
}
        footer .nav-link {
            padding: 0.25rem 0;
            color: var(--oceanic-gray-600);
            transition: color 0.2s ease;
        }
        
        footer .nav-link:hover {
            color: var(--bs-primary);
        }
        
        /* Feature icons */
        .feature-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--bs-border-radius);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }
        
        /* Utilities */
        .shadow-sm {
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1) !important;
        }
        
        .shadow {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
        }
        
        .shadow-md {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
        }
        
        .rounded-4 {
            border-radius: var(--bs-border-radius-xl) !important;
        }
        
        /* Avatar */
        .avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--oceanic-blue-100);
            border: 1px solid var(--oceanic-blue-200);
            overflow: hidden;
        }
        
        .avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand">Oceanic</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.user') }}">My Posts</a>
                    </li>
                    @endauth
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    @auth
                        <!-- New Create Post Button -->
                       

                        <!-- Profile Dropdown -->
                        <div class="dropdown">
                            <button class="btn btn-link text-dark d-flex align-items-center gap-2 text-decoration-none p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(auth()->user()->avatar)
                                <div class="avatar">
                                    <img src="{{ auth()->user()->avatar_url }}" 
                                         alt="Profile" 
                                         onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                                </div>
                                @else
                                <div class="avatar">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="text-primary">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                @endif
                                <span>{{ auth()->user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            
                            <div class="dropdown-menu dropdown-menu-end">
                                <div class="dropdown-header">
                                    <p class="mb-0 fw-medium">{{ auth()->user()->name }}</p>
                                    <p class="mb-0 small text-muted text-truncate">{{ auth()->user()->email }}</p>
                                </div>
                                <a href="{{ route('posts.user') }}" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    My Posts
                                </a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="me-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-link text-dark">Sign in</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Get started</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <main style="padding-top: 80px;">
    @yield('content')
</main>
    
    <footer>
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h3 class="font-serif fs-4 fw-semibold mb-3">Oceanic</h3>
                    <p class="text-muted">A minimalist publishing platform for thoughtful creators.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h4>PRODUCT</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="#" class="nav-link">Features</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">API</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h4>RESOURCES</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="#" class="nav-link">Documentation</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Guides</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Blog</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h4>COMPANY</h4>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Careers</a></li>
                        <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-top py-3 text-center">
                <p class="text-muted mb-0">&copy; {{ date('Y') }} Oceanic. All rights reserved.</p>
            </div>
        </div>
    </footer>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>

