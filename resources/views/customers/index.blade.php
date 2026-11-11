{{-- Customer list: one view used for the full list and for every filter --}}
@extends('layouts.app')

@section('title', $title)

@section('content')
    {{-- Page heading and number of matching customers --}}
    <div class="page__head">
        <h1 class="page__title">{{ $title }}</h1>
        <p class="page__count">
            <span class="fig">{{ $customers->total() }}</span> {{ Str::plural('customer', $customers->total()) }}
        </p>
    </div>

    <div class="panel">
        {{-- Filter form: sends ?gender=...&birthday=... to CustomerController@index --}}
        <form class="toolbar" method="GET" action="{{ route('customers.index') }}">
            <div class="field">
                <label for="gender">Gender</label>
                <div class="select">
                    <select id="gender" name="gender">
                        <option value="">All genders</option>
                        <option value="Male" @selected($gender === 'Male')>Male ({{ $counts['male'] }})</option>
                        <option value="Female" @selected($gender === 'Female')>Female ({{ $counts['female'] }})</option>
                    </select>
                </div>
            </div>

            <div class="field">
                <label for="birthday">Birthday</label>
                <div class="select">
                    <select id="birthday" name="birthday">
                        <option value="">Any year</option>
                        <option value="after2000" @selected($birthday === 'after2000')>Born after 2000 ({{ $counts['after2000'] }})</option>
                    </select>
                </div>
            </div>

            <div class="toolbar__actions">
                <button type="submit" class="btn btn--primary">Apply filters</button>
                @if ($gender || $birthday)
                    <a class="btn btn--outline" href="{{ route('customers.index') }}">Clear</a>
                @endif
            </div>
        </form>

        @if ($customers->isEmpty())
            {{-- Nothing to show --}}
            <div class="empty">
                <h2>No customers found</h2>
                <p>There are no customers for this selection.</p>
                <a class="btn btn--primary" href="{{ route('customers.index') }}">Show all customers</a>
            </div>
        @else
            {{-- Customer table --}}
            <div class="table-scroll">
                <table class="register">
                    <caption class="visually-hidden">{{ $title }}, page {{ $customers->currentPage() }} of {{ $customers->lastPage() }}</caption>
                    <thead>
                        <tr>
                            <th scope="col" class="col-no">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Address</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Birthday</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                {{-- Row number continues across pages (page 2 starts at 11) --}}
                                <td class="col-no fig" data-label="No.">{{ $customers->firstItem() + $loop->index }}</td>
                                <td class="cell-name" data-label="Name">{{ $customer->name }}</td>
                                <td class="cell-email" data-label="Email">
                                    {{-- <wbr> lets a long email wrap at the @ --}}
                                    <a href="mailto:{{ $customer->email }}">{!! str_replace('@', '<wbr>@', e($customer->email)) !!}</a>
                                </td>
                                <td class="cell-address" data-label="Address">{!! nl2br(e($customer->address)) !!}</td>
                                <td class="cell-phone fig" data-label="Phone Number">{{ $customer->phoneNumber }}</td>
                                <td data-label="Gender"><span class="tag">{{ $customer->gender }}</span></td>
                                <td class="cell-birthday" data-label="Birthday">
                                    <span class="fig">{{ $customer->birthday->format('d M Y') }}</span>
                                    <span class="age">{{ $customer->birthday->age }} years old</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Page links, 10 customers per page --}}
            {{ $customers->links('customers.partials.pagination') }}
        @endif
    </div>
@endsection
