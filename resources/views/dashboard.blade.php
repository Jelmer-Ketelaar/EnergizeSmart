<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

<x-app-layout>
    <x-slot name="header">
        <h2 class="header-title">
            {{ __('Energizesmart') }}
        </h2>
    </x-slot>

    <div class="main-container">
        <div class="content-container">
            <!-- Hero Section -->
            <div id="hero-section">
                <div class="hero-content">

                    <h1 class="hero-title">Welcome to Energizesmart</h1>
                    <p class="hero-subtitle">Monitor and optimize your energy usage with ease and efficiency.</p>

                    <div class="hero-buttons">
                        <a href="{{ route('energy.daily', ['userId' => Auth::user()->id]) }}"
                           class="hero-button blue-button">
                            View Today's Usage
                        </a>
                        <a href="{{ route('energy.compare', ['userId' => Auth::user()->id]) }}"
                           class="hero-button green-button">
                            Compare Weekly Usage
                        </a>
                        <a href="{{ route('login') }}" class="hero-button blue-button">
                            Log in to view today's usage
                        </a>
                        <a href="{{ route('login') }}" class="hero-button green-button">
                            Log in to compare weekly usage
                        </a>
                    </div>
                </div>
            </div>

            <!-- Features Section -->
            <div class="features-grid">
                <div class="feature-box">
                    <div class="feature-icon blue-icon">
                        <!-- SVG Icon -->
                    </div>
                    <h3 class="feature-title">Real-Time Monitoring</h3>
                    <p class="feature-text">Keep track of your energy consumption in real-time, ensuring efficiency and
                        savings.</p>
                </div>

                <div class="feature-box">
                    <div class="feature-icon green-icon">
                        <!-- SVG Icon -->
                    </div>
                    <h3 class="feature-title">Historical Data</h3>
                    <p class="feature-text">Analyze your energy usage trends over time with comprehensive historical
                        data.</p>
                </div>

                <div class="feature-box">
                    <div class="feature-icon yellow-icon">
                        <!-- SVG Icon -->
                    </div>
                    <h3 class="feature-title">Optimized Insights</h3>
                    <p class="feature-text">Receive personalized tips and insights to optimize energy consumption.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
