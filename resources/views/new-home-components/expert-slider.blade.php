<section class="profiles-section" id="profilesSection">
    <div class="cinematic-line top"></div>
    <div class="cinematic-line bottom"></div>

    <div class="container">

        {{-- Header --}}
        <div class="">

            <h2>
                Meet <span class="script">Verified Expert</span>
            </h2>

            
        </div>

        @php
            $experts = [
                [
                    'name' => 'Dhara',
                    'role' => 'IELTS Trainer',
                    'img' => asset('images/universities/Dhara.png'),
                    'desc' => 'Certified IELTS Trainer with 5+ Years Expertise.',
                    'rating' => '5',
                    'reviews' => '52',
                    'learners' => '3657'
                ],
                [
                    'name' => 'Afrin',
                    'role' => 'IELTS Trainer',
                    'img' => asset('images/universities/Afrin.png'),
                    'desc' => '80%+ success rate across multiple IELTS batches.',
                    'rating' => '5',
                    'reviews' => '65',
                    'learners' => '4677'
                ],
                [
                    'name' => 'Rishita',
                    'role' => 'IELTS Trainer',
                    'img' => asset('images/universities/Rishita.png'),
                    'desc' => 'British Council Certified – 6+ Years Experience.',
                    'rating' => '4',
                    'reviews' => '57',
                    'learners' => '5668'
                ],
            ];
        @endphp

        {{-- Slider --}}
        <div class="slider-wrap">
            <div class="slider-track" id="sliderTrack">
                @foreach($experts as $expert)
                    <div class="profile-slide">
                        <div class="profile-card">
                            <img src="{{ $expert['img'] }}" alt="{{ $expert['name'] }}">

                            <div class="overlay"></div>

                            @if($expert['rating'])
                                <div class="verified">
                                    <!-- ✓ VERIFIED -->
                                    Top Educator
                                </div>
                            @endif

                            <div class="profile-info">
                                <div class="top">
                                    <h3>{{ $expert['name'] }} <span>({{ $expert['role'] }})</span></h3>
                                    <div>{{ $expert['desc'] }}</div>
                                </div>
                                <hr>
                                <div class="meta">
                                    <div>Learners Guided : {{ $expert['learners'] }}</div>

                                    <div class="rating" style="justify-content: right;">
                                        <p class="">
                                        @php
                                            $fullStars = floor($expert['rating']);
                                            $hasHalfStar = ($expert['rating'] - $fullStars) >= 0.5;
                                        @endphp

                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $fullStars)
                                                <span class="star filled">
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            @elseif($hasHalfStar && $i == $fullStars + 1)
                                                <span class="star half">
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            @else
                                                <span class="star empty">
                                                    <i class="fa fa-star"></i>
                                                </span>
                                            @endif
                                        @endfor

                                        
                                    </p>   
                                    <p class="rating-text" style="color: white;">
                                            {{ $expert['rating'] }} ({{ $expert['reviews'] }} Reviews)
                                        </p>  
                                    </div>                       
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Controls --}}
            <div class="controls">
                <button id="prev">‹</button>
                <div class="dots" id="dots"></div>
                <button id="next">›</button>
            </div>
        </div>

        {{-- CTA --}}
        <!-- <div class="cta-wrap">
            <a href="{{ url('/register') }}" class="cta-btn">
                Book Free Counselling
                <span class="shine"></span>
            </a>
        </div> -->
    </div>
</section>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&display=swap');

:root{
    --primary:#FC9118;
}

.profiles-section{
    position:relative;
    background:#f1f1f1;
    padding:30px 20px;
    overflow:hidden;
}

.cinematic-line{
    position:absolute;
    left:0;
    width:100%;
    height:1px;
    background:linear-gradient(to right,transparent,var(--primary),transparent);
}
.cinematic-line.top{top:0}
.cinematic-line.bottom{bottom:0}

.container{
    max-width:1200px;
    margin:auto;
}

/* .section-header{
    text-align:center;
    margin-bottom:70px;
} */
.divider{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:14px;
}
.divider span{
    width:40px;
    height:1px;
    background:rgba(46,125,50,.3);
}
.divider small{
    font-size:11px;
    letter-spacing:.35em;
    font-weight:800;
    color:var(--primary);
}

/* .section-header h2{
    font-size:52px;
    margin-top:18px;
} */
/* .section-header .script{
    font-family:'Dancing Script',cursive;
    color:var(--primary);
} */
/* .section-header p{
    max-width:640px;
    margin:18px auto 0;
    color:#6b7280;
    font-size:18px;
} */

.slider-wrap{
    position:relative;
}

.slider-track{
    position:relative;
    height:420px;
}

.profile-slide{
    position:absolute;
    top:0;
    left:50%;
    width:360px;
    transform-origin:center;
    transition:all 1s cubic-bezier(.23,1,.32,1);
}

.profile-card{
    position:relative;
    height:380px;
    border-radius:40px;
    overflow:hidden;
    background:transparent;
}

.profile-card img{
    width:100%;
    height:100%;
    object-fit:cover;
    transition:transform 2s;
}
.profile-card:hover img{
    transform:scale(1.1);
}

.overlay{
    position:absolute;
    inset:0;
    background:linear-gradient(to top,rgba(0,0,0,.9),rgba(0,0,0,.2),transparent);
}

.verified{
    position:absolute;
    top:24px;
    left:24px;
    background:var(--primary);
    backdrop-filter:blur(12px);
    padding:6px 14px;
    border-radius:20px;
    color:#fff;
    font-size:11px;
    font-weight:800;
}

.profile-info{
    position:absolute;
    bottom:20px;
    left:20px;
    right:20px;
    background:rgba(255,255,255,.1);
    backdrop-filter:blur(20px);
    border-radius:26px;
    padding:22px;
    color:#fff;
}

.profile-info h3{
    color: #fff;
    font-size:22px;
    margin: 0 !important;
    padding: 0 !important;
}
.profile-info h3 span{
    /* opacity:.8; */
    font-size: 18px;
    color: var(--primary);
}

/* .profile-info .top{
    display:flex;
    justify-content:space-between;
    align-items:center;
} */

.rating{
    /* background:var(--primary);
    padding:6px 12px;
    border-radius:20px;
    font-size:10px;
    font-weight:800; */
    color: #fff;
    font-size:13px;
}

.meta{
    /* margin-top:14px; */
    font-size:13px;
    color: #fff;
    display: flex;
    justify-content: space-between;
    /* opacity:.85; */
}

.controls{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:20px;
    /* margin-top:30px; */
}

.controls button{
    width:52px;
    height:52px;
    border-radius:50%;
    border:none;
    background:#fff;
    font-size:26px;
    box-shadow:0 10px 30px rgba(0,0,0,.15);
    cursor:pointer;
}

.dots{
    display:flex;
    gap:10px;
}
.dots span{
    width:10px;
    height:10px;
    border-radius:50%;
    background:#d1d5db;
    transition:.4s;
}
.dots span.active{
    width:34px;
    background:var(--primary);
    border-radius:20px;
}

.cta-wrap{
    margin-top:30px;
    text-align:center;
}

.cta-btn{
    position:relative;
    display:inline-flex;
    align-items:center;
    gap:12px;
    height:64px;
    padding:0 52px;
    border-radius:40px;
    background:var(--primary);
    color:#fff;
    font-size:13px;
    font-weight:900;
    letter-spacing:.25em;
    text-transform:uppercase;
    overflow:hidden;
}

.cta-btn .shine{
    position:absolute;
    inset:0;
    transform:translateX(-100%);
    background:linear-gradient(to right,transparent,rgba(255,255,255,.4),transparent);
}
.cta-btn:hover .shine{
    transform:translateX(100%);
    transition:1s;
}


.rating{
    display:flex;
    align-items:center;
    flex-wrap:wrap;
    gap:2px;
    font-size:13px;
    color:#fff;
}

.star{
    position:relative;
    font-size:14px;
    line-height:1;
}

/* Full star */
.star.filled i{
    color:#FC9118;
}

/* Empty star */
.star.empty i{
    color:#d1d5db;
}

/* Half star */
.star.half i{
    color:#d1d5db;
}
.star.half::before{
    content:'\f005';
    font-family:'FontAwesome';
    position:absolute;
    left:0;
    top:0;
    width:50%;
    overflow:hidden;
    color:#FC9118;
}

/* Text */
.rating-text{
    margin-left:6px;
    font-size:12px;
    opacity:.9;
    white-space:nowrap;
}

</style>
<script>
const slides = document.querySelectorAll('.profile-slide');
const dotsWrap = document.getElementById('dots');
let index = 0;
let paused = false;

slides.forEach((_,i)=>{
    const d=document.createElement('span');
    if(i===0)d.classList.add('active');
    dotsWrap.appendChild(d);
});
const dots = dotsWrap.children;

function update(){
    slides.forEach((slide,i)=>{
        let pos = i - index;
        if(pos < -2) pos += slides.length;
        if(pos > 2) pos -= slides.length;

        slide.style.transform = `
            translateX(calc(-50% + ${pos * 110}%))
            scale(${pos === 0 ? 1 : 0.82})
        `;
        slide.style.opacity = pos===0?1:Math.abs(pos)<=1?.5:0;
        slide.style.filter = pos===0?'blur(0)':'blur(4px)';
        slide.style.zIndex = pos===0?30:10;
    });

    [...dots].forEach(d=>d.classList.remove('active'));
    dots[index].classList.add('active');
}

document.getElementById('next').onclick=()=>{index=(index+1)%slides.length;update();}
document.getElementById('prev').onclick=()=>{index=(index-1+slides.length)%slides.length;update();}

setInterval(()=>{
    if(!paused){index=(index+1)%slides.length;update();}
},4000);

document.getElementById('profilesSection')
    .addEventListener('mouseenter',()=>paused=true);
document.getElementById('profilesSection')
    .addEventListener('mouseleave',()=>paused=false);

update();
</script>