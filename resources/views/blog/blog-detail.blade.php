@extends('layouts.app')


@section('content')
          <style>
            /* ===== Base ===== */
            .new-blog-page-wrap { padding: 16px 10px; background: #f7f7fb; margin-top: 120px; }
            .new-blog-container { max-width: 1200px; margin: 0 auto; }

            /* ===== Grid (wide left, narrow right) ===== */
            .new-blog-grid {
              display: grid;
              grid-template-columns: 3fr 1fr;
              gap: 24px;
            }
            @media (max-width: 1024px) { .new-blog-grid { grid-template-columns: 2fr 1fr; } }
            @media (max-width: 860px)  { .new-blog-grid { grid-template-columns: 1fr; } }

            .new-blog-left-col  { display: flex; flex-direction: column; gap: 16px; }
            .new-blog-right-col { position: relative; }

            /* Sticky sidebar */
            .new-blog-sidebar-sticky {
              position: sticky;
              top: 90px;
              display: flex;
              flex-direction: column;
              gap: 16px;
            }

            /* ===== Card Shells ===== */
            .new-blog-card {
              background: #ffffff;
              border: 1px solid #e9e9ef;
              border-radius: 12px;
              overflow: hidden;
              box-shadow: 0 6px 18px rgba(0,0,0,0.06);
            }
            .new-blog-card-body { padding: 16px 25px; }

            /* Hero / Title */
            .new-blog-title { margin: 0; font-size: 32px; line-height: 1.25; font-weight: 700; color: #1e1e25; text-align: left; }
            @media (max-width: 576px){ .new-blog-title { font-size: 28px; } .new-blog-meta { font-size: 12px; color: #7a7a85; margin-top: 6px; } .new-blog-card-body { padding: 16px 18px; } .new-blog-page-wrap {margin-top: 100px;} }

            .new-blog-content h2 {
              text-align: left;
              font-weight: 600;
              margin-bottom: 5px;
            }

            .new-blog-content h3{
              font-weight: 600;
              margin-bottom: 5px;
            }

            .new-blog-content ol {
              list-style: none;         /* Remove numbers */
              margin: 0;
              padding-left: 20px;       /* Space for custom bullet */
            }

            .new-blog-content ol li {
              position: relative;
              padding-left: 15px;       /* Space between bullet and text */
            }

            .new-blog-content ol li::before {
              content: "⮞";             /* Custom bullet */
              position: absolute;
              left: 0;                  /* Keeps bullet outside text */
              top: 0;
              font-weight: bold;
              color: #000;              /* Change if needed */
            }


            /* Feature Image */
            .new-blog-hero-img {
              width: 100%;
              height: auto;
              object-fit: cover;
            }
            @media (max-width: 576px){ .new-blog-content ol { padding-left: 10px; }}

            /* Content */
            .new-blog-content { color:#262633; font-size: 16px; line-height: 1.65; }
            .new-blog-content p { margin-bottom: 5px; text-align: justify; }
            .new-blog-content img { width: 100%; height: auto; display: block; border-radius: 8px; }
            .new-blog-content table {
              width: 100%; border-collapse: collapse; margin: 12px 0; font-size: 15px;
            }
            .new-blog-content a {
              text-decoration: none;
            }
            .new-blog-content th, .new-blog-content td {
              border: 1px solid #e3e3ea; padding: 8px; text-align: left;
            }
            .new-blog-sep { height: 1px; background: #eee; margin: 12px 0; }

            /* FAQ */
            .new-blog-faq-wrap { margin-top: 8px; }
            .new-blog-faq-title { font-size: 20px; font-weight: 800; margin: 8px 0 6px; color:#1e1e25; }
            .new-blog-faq-q { font-size: 16px; font-weight: 700; margin: 10px 0 4px; color:#1e1e25; }
            .new-blog-faq-a { margin: 0 0 10px; color:#262633; }

            /* Widgets (Right) */
            .new-blog-widget {
              background: #fff; border: 1px solid #e9e9ef; border-radius: 12px; overflow: hidden;
            }
            .new-blog-widget-head { padding: 12px 14px; border-bottom: 1px solid #eee; }
            .new-blog-widget-title { margin:0; font-size: 18px; font-weight: 800; color:#1e1e25; }
            .new-blog-widget-body { padding: 12px 14px; }

            .new-blog-list {
              list-style: none; padding: 0; margin: 0; display: grid; gap: 8px;
            }
            .new-blog-list a {
              display: block; padding: 10px 12px; border: 1px solid #e9e9ef; border-radius: 10px;
              color: #1e1e25; text-decoration: none; font-weight: 600; font-size: 14px;
              transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
            }
            .new-blog-list a:hover {
              transform: translateY(-2px);
              border-color: #FC9118;
              box-shadow: 0 6px 16px rgba(252,145,24,.25);
            }

            /* Banner */
            .new-blog-banner { border: 1px solid #e9e9ef; border-radius: 12px; overflow: hidden; background:#fff; }
            .new-blog-banner img { width: 100%; height: auto; display: block; object-fit: cover; }

            /* Buttons (Theme #FC9118) */
            .new-blog-custom-btn {
              background-color: #FC9118;
              padding: 6px 14px;
              border-radius: 11px;
              color: white;
              text-decoration: none;
              display: inline-flex;
              align-items: center;
              font-weight: 600;
              position: relative;
              overflow: hidden;
              transition: all 0.4s ease;
              box-shadow: 0 3px 10px rgba(252, 145, 24, 0.4);
              border: none; cursor: pointer;
            }
            .new-blog-custom-btn::before {
              content: ""; position: absolute; top: 0; left: -100%; width: 100%; height: 100%;
              background: rgba(255,255,255,0.25); transform: skewX(-20deg); transition: 0.6s;
            }
            .new-blog-custom-btn:hover {
              transform: translateY(-2px) scale(1.03);
              box-shadow: 0 6px 15px rgba(252,145,24,0.6);
              background-position: right center;
            }
            .new-blog-custom-btn:hover::before { left: 200%; }

            /* Back link */
            .new-blog-top-actions { display:flex; gap:10px; align-items:center; flex-wrap: wrap; }

            /* Anshul changes Do not Touch */
         .new-blog-page-wrap ul {
        list-style: none;
        padding-left: 0;
    }

    .new-blog-page-wrap ul li {
        position: relative;
        padding-left: 22px;
    }

    .new-blog-page-wrap ul li::before {
        content: "•";
        position: absolute;
        left: 0;
        top: 0;
    }


          </style>

          <style>
            /* ===== FINAL MOBILE FIXES ===== */

    /* Prevent horizontal scroll globally */
    html, body {
      overflow-x: hidden;
    }

    /* Force all content to stay inside screen */
    .new-blog-content * {
      max-width: 100% !important;
      word-break: break-word;
    }

    /* Fix long words / URLs */
    .new-blog-content p,
    .new-blog-content h1,
    .new-blog-content h2,
    .new-blog-content h3,
    .new-blog-content a {
      overflow-wrap: break-word;
      word-wrap: break-word;
    }

    /* Fix tables properly */
    .new-blog-content table {
      display: block;
      overflow-x: auto;
      width: 100%;
    }

    /* Fix iframe / embeds */
    .new-blog-content iframe {
      width: 100% !important;
      height: auto;
    }

    /* Fix images */
    .new-blog-content img {
      max-width: 100% !important;
      height: auto !important;
    }

    /* Fix pre/code blocks (if any) */
    .new-blog-content pre {
      overflow-x: auto;
      white-space: pre-wrap;
    }

    /* GRID FIX for small screens */
    @media (max-width: 480px) {
      .new-blog-grid {
        display: block;
      }

      .new-blog-card-body {
        padding: 12px;
      }

      .new-blog-title {
        font-size: 22px;
      }
    }
          </style>

          <section class="new-blog-page-wrap">
            <div class="new-blog-container">
              <div class="new-blog-grid">
                <!-- LEFT: content -->
                <div class="new-blog-left-col">
                  <!-- Title + Meta -->
                  <div class="new-blog-card">
                    <div class="new-blog-card-body">

                      <h1 class="new-blog-title" style="margin-top:12px;">{{ $data['blog']['title'] }}</h1>
                      <div class="new-blog-meta">{{ \Carbon\Carbon::parse($data['blog']['created_at'])->format('F j, Y') }}</div>
                    </div>
                    @if(!empty($data['blog']['images']))
                      <img src="{{ asset($data['blog']['images']) }}" alt="{{ $data['blog']['title'] }}" class="new-blog-hero-img">
                    @endif
                    <div class="new-blog-card-body">
                      <div class="new-blog-content">
                        {!! preg_replace('/<\/?strong>/', '', $data['blog']['content']) !!}
                      </div>

                      {{-- FAQ --}}
                      @php
  $faqs = json_decode($data['blog']['faq'], true);
                      @endphp

                      @if (!empty($faqs) && is_array($faqs) && count($faqs) > 0)
                            <div class="new-blog-sep"></div>
                            <div class="new-blog-faq-wrap">
                              <h2 class="new-blog-faq-title">Frequently Asked Questions</h2>
                              @php $faqs = json_decode($data['blog']['faq'], true); @endphp
                              @foreach ($faqs as $index => $faq)
                                    <div class="new-blog-faq-item">
                                      <div class="new-blog-faq-q">Q{{ $index + 1 }}. {{ $faq['question'] }}</div>
                                      <p class="new-blog-faq-a">{{ $faq['answer'] }}</p>
                                    </div>
                              @endforeach
                            </div>
                      @endif
                    </div>
                  </div>
                </div>

                <!-- RIGHT: sidebar -->
                <aside class="new-blog-right-col">
                  <div class="new-blog-sidebar-sticky">
                    {{-- Registration form --}}
                    <div class="new-blog-card">
                      <div class="new-blog-card-body" style="padding:0;">
                        @include('./components/landing-page-registration-study-abroad')
                      </div>
                    </div>

                    {{-- Banner --}}
                    <div class="new-blog-banner">
                      <img src="{{ asset('/new-home-images/WTS-Blog-Image.webp') }}" alt="WTS Banner">
                    </div>
                  </div>
                </aside>
              </div>
            </div>
          </section>
@endsection
