{{--

/**
*
* Created a new component <x-rtl.widgets._w-table-one/>.
*
*/

--}}


<div class="widget widget-table-one">
    <div class="widget-heading">
        <h5 class="">{{$title}}</h5>
        <div class="task-action">

        </div>
    </div>

    <div class="widget-content">
        <div class="transactions-list">
            <div class="t-item">
                <div class="t-company-name">
                    <div class="t-icon">
                        <div class="avatar">
                            <span class="avatar-title">UT</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>Utilisateurs</b></h4>
                    </div>

                </div>
                <div class="t-rate ">
                    <p><span>{{ $utilisateur }}</span></p>
                </div>
            </div>
        </div>

        <div class="transactions-list t-info">
            <div class="t-item">
                <div class="t-company-name">
                    <div class="t-icon">
                        <div class="avatar">
                            <span class="avatar-title">MP</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>Membres Physique</b></h4>
                    </div>
                </div>
                <div class="t-rate">
                    <p><span>{{ $membrephysique }}</span></p>
                </div>
            </div>
        </div>

        <div class="transactions-list t-secondary">
            <div class="t-item">
                <div class="t-company-name">
                    <div class="t-icon">
                        <div class="avatar">
                            <span class="avatar-title">MM</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>Membres Moral</b></h4>
                    </div>

                </div>
                <div class="t-rate ">
                    <p><span>{{ $membremorale }}</span></p>
                </div>
            </div>
        </div>








    </div>
</div>
