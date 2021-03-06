@extends('layouts.app')
@section('style')
<style>
table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2
}
</style>
@endsection
@section('content')
<h2>All Available Transports from</h2>

<table>
  <tr>
    <th>Transport Name</th>
    <th>Type</th>
    <th>Image</th>
    <th>Fare</th>
    <th>Description</th>
    <th>Likes</th>
    <th>Dislikes</th>
    <th>Action</th>
  </tr>
  <tr>
    <td><a href="{{route('transport_profile')}}">MTCL</a></td>
    <td>  <a href=""></a></td>
    <td><img style="height: 100px;" src="" /></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>  <a href="{{route('give_feedback')}}"><button type="button" class="btn btn-primary">Give Feedback</button></a></td>
  </tr>
</table>
@endsection