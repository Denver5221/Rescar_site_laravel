{{--

/**
*
* Created a new component <x-rtl.widgets._w-activity-four/>.
*
*/

--}}


<div class="widget widget-activity-four">

    <div class="widget-heading">
        <h5 class="">{{$title}}</h5>
    </div>

    <div class="widget-content">

        <div class="mt-container-ra mx-auto">
            <div class="timeline-line">

                @if ($activities->isNotEmpty())

                @foreach($activities as $activity)
                @php
                    $randomClass = $activityClasses[array_rand($activityClasses)];
                @endphp
                <div class="item-timeline {{ $randomClass }}">
                    <div class="t-dot" data-original-title="" title=""></div>
                    <div class="t-text">
                        <p>{{ $activity->title }}</p>
                        <span class="badge">{{ $activity->user->information->nom }} {{ $activity->user->information->prenom }}</span>
                        <p class="t-time">{{ $activity->created_at->format('H:i') }}</p>
                    </div>
                </div>
                @endforeach

                @endif


                {{-- <div class="item-timeline timeline-primary">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p><span>Updated</span> Server Logs</p>
                        <span class="badge">Pending</span>
                        <p class="t-time">Just Now</p>
                    </div>
                </div>

                <div class="item-timeline timeline-success">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Send Mail to <a href="javascript:void(0);">HR</a> and <a href="javascript:void(0);">Admin</a></p>
                        <span class="badge">Completed</span>
                        <p class="t-time">2 min ago</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-danger">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Backup <span>Files EOD</span></p>
                        <span class="badge">Pending</span>
                        <p class="t-time">14:00</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-dark">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Collect documents from <a href="javascript:void(0);">Sara</a></p>
                        <span class="badge">Completed</span>
                        <p class="t-time">16:00</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-warning">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Conference call with <a href="javascript:void(0);">Marketing Manager</a>.</p>
                        <span class="badge">In progress</span>
                        <p class="t-time">17:00</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-secondary">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Rebooted Server</p>
                        <span class="badge">Completed</span>
                        <p class="t-time">17:00</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-warning">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Send contract details to Freelancer</p>
                        <span class="badge">Pending</span>
                        <p class="t-time">18:00</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-dark">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Kelly want to increase the time of the project.</p>
                        <span class="badge">In Progress</span>
                        <p class="t-time">19:00</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-success">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Server down for maintanence</p>
                        <span class="badge">Completed</span>
                        <p class="t-time">19:00</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-secondary">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Malicious link detected</p>
                        <span class="badge">Block</span>
                        <p class="t-time">20:00</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-warning">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Rebooted Server</p>
                        <span class="badge">Completed</span>
                        <p class="t-time">23:00</p>
                    </div>
                </div>

                <div class="item-timeline timeline-primary">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p><span>Updated</span> Server Logs</p>
                        <span class="badge">Pending</span>
                        <p class="t-time">Just Now</p>
                    </div>
                </div>

                <div class="item-timeline timeline-success">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Send Mail to <a href="javascript:void(0);">HR</a> and <a href="javascript:void(0);">Admin</a></p>
                        <span class="badge">Completed</span>
                        <p class="t-time">2 min ago</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-danger">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Backup <span>Files EOD</span></p>
                        <span class="badge">Pending</span>
                        <p class="t-time">14:00</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-dark">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Collect documents from <a href="javascript:void(0);">Sara</a></p>
                        <span class="badge">Completed</span>
                        <p class="t-time">16:00</p>
                    </div>
                </div>

                <div class="item-timeline  timeline-warning">
                    <div class="t-dot" data-original-title="" title="">
                    </div>
                    <div class="t-text">
                        <p>Conference call with <a href="javascript:void(0);">Marketing Manager</a>.</p>
                        <span class="badge">In progress</span>
                        <p class="t-time">17:00</p>
                    </div>
                </div> --}}

            </div>
        </div>


    </div>
</div>
