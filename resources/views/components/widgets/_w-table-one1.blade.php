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
                            <span class="avatar-title">PO</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>Posts</b></h4>
                    </div>

                </div>
                <div class="t-rate ">
                    <p><span>{{ $posts }}</span></p>
                </div>
            </div>
        </div>

        <div class="transactions-list t-info">
            <div class="t-item">
                <div class="t-company-name">
                    <div class="t-icon">
                        <div class="avatar">
                            <span class="avatar-title">CO</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>Commentaires</b></h4>
                    </div>
                </div>
                <div class="t-rate">
                    <p><span>{{ $commentaire }}</span></p>
                </div>
            </div>
        </div>

        <div class="transactions-list t-secondary">
            <div class="t-item">
                <div class="t-company-name">
                    <div class="t-icon">
                        <div class="avatar">
                            <span class="avatar-title">Vu</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>Vues</b></h4>
                    </div>

                </div>
                <div class="t-rate ">
                    <p><span>{{ $vue }}</span></p>
                </div>
            </div>
        </div>


        <div class="transactions-list t-info">
            <div class="t-item">
                <div class="t-company-name">
                    <div class="t-icon">
                        <div class="avatar">
                            <span class="avatar-title">JA</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>J'aimes</b></h4>
                    </div>
                </div>
                <div class="t-rate">
                    <p><span>{{ $like }}</span></p>
                </div>
            </div>
        </div>





    </div>
</div>
