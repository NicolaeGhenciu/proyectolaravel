@section('titulo', 'Lista de Clientes')

@extends('base')

@section('contenido')

    <h1 class="text-center"><b>NOTICIAS</b></h1>

    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Noticia #1
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum nisi expedita facilis enim ut
                    dicta dolore suscipit debitis fugit minima, illum architecto harum voluptate impedit reiciendis
                    voluptas quos distinctio sequi.
                    Dignissimos, quam? Quasi dolores recusandae, necessitatibus repudiandae laboriosam debitis ipsam
                    nobis dolore aliquid laudantium ab at mollitia exercitationem praesentium consequuntur libero ullam
                    facilis, explicabo magni. Odio sapiente nihil rerum dicta.
                    A natus consectetur saepe iure assumenda, possimus sit aspernatur beatae reprehenderit quod sed,
                    eveniet, ex tempore. Repellendus quos perspiciatis dolorem est non quidem, culpa voluptatibus quis.
                    Perspiciatis reprehenderit obcaecati assumenda!
                    Deserunt animi praesentium, harum, cupiditate illo sint iste accusantium obcaecati esse non in quo
                    voluptate, velit impedit alias eum tenetur. Sequi nobis corrupti eaque beatae consequuntur, aliquid
                    eos enim reprehenderit.
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Noticia #2
                </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio sit ab officiis illo molestias et porro
                    adipisci quae omnis fugiat sint aliquid eligendi, voluptatum nobis fuga modi reprehenderit voluptatibus
                    veniam?
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Noticia #3
                </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto nesciunt odit distinctio
                    perspiciatis nemo similique! Dolores odio eveniet, ipsa illum in, quis alias nam magnam nulla
                    consectetur, esse quisquam obcaecati?
                    Repellendus dolor aliquam eveniet at dolore perspiciatis. Nihil animi, doloribus eos, ut sunt,
                    reiciendis expedita laboriosam quam laudantium suscipit sapiente quidem alias impedit pariatur quae
                    ex asperiores minus qui praesentium.
                    Eligendi, saepe! Repellat neque sed, perferendis quia autem et nemo ipsum reiciendis provident,
                    quaerat tenetur optio dignissimos consequatur. Tenetur cupiditate veniam reprehenderit illo
                    temporibus amet provident tempora ea neque praesentium.
                </div>
            </div>
        </div>
    </div>

@endsection
