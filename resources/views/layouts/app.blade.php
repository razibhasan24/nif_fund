<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NIF Foundation Admin Panel</title>
  @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 flex">
  <!-- Sidebar -->
  <aside class="w-64 bg-blue-800 text-white min-h-screen p-4">
    <h1 class="text-2xl font-bold mb-8">NIF Foundation</h1>
    <nav>
      <ul class="space-y-2">
        <li><a href="{{ route('dashboard') }}" class="block py-2 px-4 hover:bg-blue-700 rounded">Dashboard</a></li>
        <li><a href="{{ route('members.index') }}" class="block py-2 px-4 hover:bg-blue-700 rounded">Members</a></li>
        <li><a href="{{ route('funds.index') }}" class="block py-2 px-4 hover:bg-blue-700 rounded">Funds</a></li>
        <li><a href="{{ route('loans.index') }}" class="block py-2 px-4 hover:bg-blue-700 rounded">Loans</a></li>
        <li><a href="{{ route('installments.index') }}" class="block py-2 px-4 hover:bg-blue-700 rounded">Installments</a></li>
      </ul>
    </nav>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-6">
    @yield('content')
  </main>
</body>
</html>
