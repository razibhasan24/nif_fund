@extends('layouts.app')

@section('content')
  <h1 class="text-2xl font-bold mb-6">সদস্য তালিকা</h1>

  <table class="w-full bg-white shadow rounded">
    <thead class="bg-blue-800 text-white">
      <tr>
        <th class="py-2 px-3">নাম</th>
        <th class="py-2 px-3">ইমেইল</th>
        <th class="py-2 px-3">মোবাইল</th>
        <th class="py-2 px-3">ঠিকানা</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($members as $member)
        <tr class="border-b hover:bg-gray-100">
          <td class="py-2 px-3">{{ $member->user->name }}</td>
          <td class="py-2 px-3">{{ $member->user->email }}</td>
          <td class="py-2 px-3">{{ $member->phone }}</td>
          <td class="py-2 px-3">{{ $member->address }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@endsection
