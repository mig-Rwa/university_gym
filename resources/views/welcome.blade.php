<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                line-height: 1.5;
                margin: 0;
                padding: 0;
                min-height: 100vh;
                background: linear-gradient(135deg, #f8fafc 0%, #e0e7ef 100%);
            }
            .center {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
            }
            .title {
                font-size: 3rem;
                font-weight: 600;
                color: #6366f1;
                margin-bottom: 1rem;
            }
            .subtitle {
                font-size: 1.25rem;
                color: #64748b;
                margin-bottom: 2rem;
            }
            .links a {
                color: #6366f1;
                text-decoration: none;
                margin: 0 1rem;
                font-weight: 600;
            }
            .links a:hover {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <!-- Auth Links Top Right -->
        <div style="position: absolute; top: 2rem; right: 2rem; z-index: 10; display: flex; gap: 1rem;">
            <a href="{{ route('login') }}" style="padding: 0.5rem 1.25rem; background: #6366f1; color: #fff; border-radius: 0.5rem; font-weight: 600; text-decoration: none; transition: background 0.2s;">Login</a>
            <a href="{{ route('register') }}" style="padding: 0.5rem 1.25rem; background: #22d3ee; color: #fff; border-radius: 0.5rem; font-weight: 600; text-decoration: none; transition: background 0.2s;">Register</a>
        </div>
        <div class="center">
            <div class="title">Laravel</div>
            <div class="subtitle">Welcome to your Laravel application!</div>
            <div class="links">
                <a href="https://laravel.com/docs">Documentation</a>
                <a href="https://laracasts.com">Laracasts</a>
                <a href="https://laravel-news.com">News</a>
                <a href="https://blog.laravel.com">Blog</a>
                <a href="https://nova.laravel.com">Nova</a>
                <a href="https://forge.laravel.com">Forge</a>
                <a href="https://vapor.laravel.com">Vapor</a>
                <a href="https://github.com/laravel/laravel">GitHub</a>
            </div>
        </div>
    </body>
</html>
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-lg font-semibold transition">Continue</button>
                </form>

                <div class="flex items-center my-4">
                    <div class="flex-grow h-px bg-gray-300"></div>
                    <span class="mx-2 text-gray-400 text-sm">OR</span>
                    <div class="flex-grow h-px bg-gray-300"></div>
                </div>

                <!-- Third-party buttons (UI only, no real auth yet) -->
                <button class="w-full mb-2 flex items-center justify-center gap-2 border rounded-lg py-2 text-sm hover:bg-gray-50">
                    <img src="https://img.icons8.com/color/16/000000/google-logo.png" alt="Google"> Continue with Google
                </button>
                <button class="w-full mb-2 flex items-center justify-center gap-2 border rounded-lg py-2 text-sm hover:bg-gray-50">
                    <img src="https://img.icons8.com/color/16/000000/facebook-new.png" alt="Facebook"> Continue with Facebook
                </button>
                <button class="w-full flex items-center justify-center gap-2 border rounded-lg py-2 text-sm hover:bg-gray-50">
                    <img src="https://img.icons8.com/color/16/000000/adobe.png" alt="Adobe"> Continue with Adobe
                </button>

                <div class="text-xs text-blue-600 mt-6 text-center hover:underline cursor-pointer">
                    Get help signing in
                </div>
            </div>
        </div>
    </div>

</body>
</html>
