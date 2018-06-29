@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    Terms of Service
                </div>

                <p>
                    By accessing and using this website, you accept and agree to be bound by the terms and provision of
                    this agreement. In addition, when using this websites particular services, you shall be subject to
                    any posted guidelines or rules applicable to such services, which may be posted and modified from
                    time to time. All such guidelines or rules are hereby incorporated by reference into the TOS.
                </p>

                <p>
                    <strong>
                        ANY PARTICIPATION IN THIS SITE WILL CONSTITUTE ACCEPTANCE OF THIS AGREEMENT. IF YOU DO NOT AGREE
                        TO ABIDE BY THE ABOVE, PLEASE DO NOT USE THIS SITE.
                    </strong>
                </p>

                <ul>
                    <li>We are not liable if you get hurt because of our site, app or data</li>
                    <li>By partaking in any submitted workouts, we assume you are fit and able enough to do so</li>
                    <li>
                        All workouts are assumed RX unless otherwise stated. This means if the workout doesn't include
                        scaled options, you must scale the workout as necessary.
                    </li>
                    <li>We take no liability if injury is caused by following any of the submitted workouts</li>
                    <li>We don't share or sell any of your personal information such as full name and email.</li>
                    <li>Your data is yours, you can contact us to retrieve it, or you can delete it at any time.</li>
                </ul>

                <p>
                    Data on {{ config('app.name') }} is created by you, the community. You should assume that all
                    workouts are created by non-professionals.
                </p>
            </div>
        </div>
    </div>
@endsection
