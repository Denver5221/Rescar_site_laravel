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
                            <span class="avatar-title">PA</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>Partenaires</b></h4>
                    </div>

                </div>
                <div class="t-rate ">
                    <p><span>{{ $partenaire }}</span></p>
                </div>
            </div>
        </div>

        <div class="transactions-list t-info">
            <div class="t-item">
                <div class="t-company-name">
                    <div class="t-icon">
                        <div class="avatar">
                            <span class="avatar-title">ME</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>Membres</b></h4>
                    </div>
                </div>
                <div class="t-rate">
                    <p><span>{{ $membre }}</span></p>
                </div>
            </div>
        </div>

        <div class="transactions-list t-secondary">
            <div class="t-item">
                <div class="t-company-name">
                    <div class="t-icon">
                        <div class="avatar">
                            <span class="avatar-title">RE</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>Recrutements</b></h4>
                    </div>

                </div>
                <div class="t-rate ">
                    <p><span>{{ $recrutement }}</span></p>
                </div>
            </div>
        </div>


        <div class="transactions-list t-info">
            <div class="t-item">
                <div class="t-company-name">
                    <div class="t-icon">
                        <div class="avatar">
                            <span class="avatar-title">AC</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>Actualites</b></h4>
                    </div>
                </div>
                <div class="t-rate">
                    <p><span>{{ $actualite }}</span></p>
                </div>
            </div>
        </div>

        <div class="transactions-list t-secondary">
            <div class="t-item">
                <div class="t-company-name">
                    <div class="t-icon">
                        <div class="avatar">
                            <span class="avatar-title">RE</span>
                        </div>
                    </div>
                    <div class="t-name">
                        <h4><b>Recrutements Partenaire</b></h4>
                    </div>

                </div>
                <div class="t-rate ">
                    <p><span>{{ $recrutementP }}</span></p>
                </div>
            </div>
        </div>



    </div>
</div>
