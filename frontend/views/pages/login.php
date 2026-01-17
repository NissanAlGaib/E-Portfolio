<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-dark-bg/80 backdrop-blur-lg p-8 rounded-lg shadow-xl border border-white/10">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-white">
                Admin Login
            </h2>
            <p class="mt-2 text-center text-sm text-gray-400">
                Please sign in to access the admin panel
            </p>
        </div>

        <?php if (isset($_GET['error'])): ?>
            <div class="bg-red-500/20 border border-red-500/50 text-red-200 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">Invalid username or password</span>
            </div>
        <?php endif; ?>

        <form class="mt-8 space-y-6" action="login_handler.php" method="POST">
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-300 mb-2">
                        Username
                    </label>
                    <input
                        id="username"
                        name="username"
                        type="text"
                        required
                        class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-white/10 bg-dark-bg/50 placeholder-gray-500 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm"
                        placeholder="Enter username">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                        Password
                    </label>
                    <input
                        id="password"
                        name="password"
                        type="password"
                        required
                        class="appearance-none rounded-lg relative block w-full px-3 py-2 border border-white/10 bg-dark-bg/50 placeholder-gray-500 text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm"
                        placeholder="Enter password">
                </div>
            </div>

            <div>
                <button
                    type="submit"
                    class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-gradient-to-r from-blue-start to-purple-end hover:from-blue-600 hover:to-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Sign in
                </button>
            </div>

            <div class="text-center">
                <a href="index.php?page=home" class="text-sm text-blue-400 hover:text-blue-300">
                    Back to Portfolio
                </a>
            </div>
        </form>
    </div>
</div>