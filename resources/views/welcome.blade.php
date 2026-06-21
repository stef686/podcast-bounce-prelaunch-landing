<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Podcast Bounce - Podcast hosting that gets out of your way</title>
    <meta name="description" content="Podcast Bounce gets your show online in minutes, shows you download numbers you can actually read, then stays out of the way. Built for independent podcasters.">

    @fonts
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @production
    <script src="https://cdn.usefathom.com/script.js" data-site="{{ config('services.fathom.site_id') }}" defer></script>
    @endproduction
</head>
<body class="bg-paper text-ink font-body antialiased overflow-x-hidden" style="-webkit-font-smoothing: antialiased; text-rendering: optimizeLegibility;">

    {{-- ============ HERO ============ --}}
    <section class="relative pb-[clamp(48px,8vw,96px)]">

        {{-- Nav --}}
        <div class="sticky top-0 z-50 bg-paper/[0.88] backdrop-blur-[12px] border-b border-hairline md:relative md:bg-transparent md:backdrop-blur-none md:border-b-0">
            <div class="max-w-[1160px] mx-auto px-5 md:px-[clamp(20px,5vw,40px)] py-3.5 md:py-6 flex items-center justify-between gap-3 md:gap-4">
                <div class="flex items-center gap-2.5">
                    <svg width="20" height="20" viewBox="0 0 22 22" aria-hidden="true" class="md:w-[22px] md:h-[22px]"><rect x="2" y="8" width="3.4" height="6" rx="1.7" fill="#0e9d6e"></rect><rect x="9.3" y="3" width="3.4" height="16" rx="1.7" fill="#0e9d6e"></rect><rect x="16.6" y="6" width="3.4" height="10" rx="1.7" fill="#15110d"></rect></svg>
                    <span class="font-display font-bold text-[17px] md:text-lg tracking-tight">Podcast Bounce</span>
                </div>
                <a href="#join" class="text-ink font-semibold text-sm md:text-[15px] border border-input-border rounded-full px-[15px] py-2 md:px-[18px] md:py-[9px] hover:border-accent hover:bg-white transition-all no-underline"><span class="md:hidden">Join</span><span class="hidden md:inline">Join the waitlist</span></a>
            </div>
        </div>

        {{-- Hero content --}}
        <div class="max-w-[1160px] mx-auto px-[clamp(20px,5vw,40px)] pt-[clamp(24px,5vw,56px)] flex flex-wrap items-center gap-[clamp(40px,6vw,80px)]">

            <div class="flex-[1_1_460px] min-w-0">
                <span class="inline-flex items-center gap-2 text-[12.5px] md:text-[13px] font-semibold tracking-wide text-accent-deep bg-accent-soft rounded-full px-3 md:px-3.5 py-[7px]">
                    <span class="w-[7px] h-[7px] rounded-full bg-accent inline-block"></span>
                    <span class="md:hidden">Private beta soon</span>
                    <span class="hidden md:inline">Podcast hosting · private beta soon</span>
                </span>

                <h1 class="font-display font-bold text-[clamp(40px,6.2vw,68px)] leading-[1.02] tracking-[-0.025em] mt-[22px]" style="text-wrap: balance;">
                    Podcast hosting that gets out of your way.
                </h1>

                <p class="text-[clamp(17px,2.1vw,21px)] leading-[1.55] text-muted mt-[22px] max-w-[30em]" style="text-wrap: pretty;">
                    Podcast Bounce gets your show online in minutes, shows you download numbers you can actually read, then stays out of the way. Built for independent podcasters.
                </p>

                {{-- Waitlist form --}}
                <div class="mt-8 max-w-[480px]">
                    @if (session('waitlist_success'))
                        <div class="flex items-center gap-3 bg-accent-soft border border-accent-border rounded-[14px] px-[18px] py-4">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0a6b4a" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-base font-medium text-accent-deep">You're on the list. We'll send you occasional emails between now and launch.</span>
                        </div>
                    @else
                        <form action="{{ route('waitlist.store') }}" method="POST" class="flex flex-col md:flex-row gap-2.5">
                            @csrf
                            <input type="text" name="website" class="!absolute !-left-[9999px] !h-0 !w-0 !overflow-hidden" tabindex="-1" autocomplete="off" aria-hidden="true">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="you@yourshow.com" aria-label="Email address" required class="w-full md:flex-[1_1_220px] min-w-0 h-[52px] md:h-[54px] border border-input-border rounded-[13px] px-4 font-body text-base bg-white text-ink outline-none transition-all focus:border-accent focus:ring-[3px] focus:ring-accent/16">
                            <button type="submit" class="w-full md:w-auto bg-accent text-white border-none rounded-[13px] px-6 h-[52px] md:h-[54px] font-body font-semibold text-base cursor-pointer whitespace-nowrap transition-all hover:bg-accent-hover hover:-translate-y-px">Join the waitlist</button>
                        </form>
                        @error('email')
                            <p class="mt-2.5 mx-0.5 text-sm text-danger">{{ $message }}</p>
                        @enderror
                        <p class="mt-3 mx-0.5 text-[13.5px] md:text-sm text-faint">No spam - just occasional emails between now and launch.</p>
                    @endif
                </div>

                {{-- Social proof
                <div class="mt-7 flex items-center gap-3.5 flex-wrap">
                    <div class="flex">
                        <span class="w-8 h-8 rounded-full bg-accent border-2 border-paper"></span>
                        <span class="w-8 h-8 rounded-full bg-tint-1 border-2 border-paper -ml-[9px]"></span>
                        <span class="w-8 h-8 rounded-full bg-tint-2 border-2 border-paper -ml-[9px]"></span>
                        <span class="w-8 h-8 rounded-full bg-ink-strong border-2 border-paper -ml-[9px]"></span>
                    </div>
                    <span class="text-[15px] text-muted">Join <strong class="text-ink font-semibold">{{ number_format($waitlistCount) }}+</strong> podcasters on the waitlist</span>
                </div> --}}
            </div>

            {{-- Hero visual — mobile (stacked) --}}
            <div class="md:hidden w-full mt-2">
                {{-- Photo + player overlay --}}
                <div class="relative rounded-[22px] overflow-hidden h-[260px]" style="box-shadow: 0 24px 48px -34px rgba(20,50,38,0.5);">
                    <img src="{{ asset('images/hero-podcaster-crop.png') }}" alt="Podcaster recording" class="w-full h-full object-cover">
                    <div class="absolute left-3.5 right-3.5 bottom-3.5 bg-white border border-hairline rounded-[15px] p-[13px_14px]" style="box-shadow: 0 16px 32px -22px rgba(20,50,38,0.6);">
                        <div class="flex items-center justify-between gap-2">
                            <span class="font-semibold text-[12.5px] text-muted">Your player</span>
                            <span class="text-[10.5px] font-semibold text-accent-deep bg-accent-soft rounded-full px-[9px] py-[3px]">Embeddable</span>
                        </div>
                        <div class="mt-[11px] flex items-center gap-[11px]">
                            <span class="w-[34px] h-[34px] rounded-full bg-accent flex items-center justify-center shrink-0"><svg width="13" height="13" viewBox="0 0 24 24" fill="#fff" aria-hidden="true"><path d="M8 5l11 7-11 7z"></path></svg></span>
                            <div class="flex-1 min-w-0">
                                <x-waveform :played="13" :total="24" />
                                <div class="flex justify-between mt-1.5 font-mono text-[9.5px] text-faint"><span>12:04</span><span>38:21</span></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Downloads + episodes row --}}
                <div class="mt-3.5 flex gap-3.5">
                    <div class="flex-1 bg-white border border-hairline rounded-[18px] p-4" style="box-shadow: 0 16px 32px -30px rgba(20,50,38,0.5);">
                        <div class="flex items-center gap-[7px]">
                            <span class="w-[7px] h-[7px] rounded-full bg-accent inline-block"></span>
                            <span class="font-semibold text-xs text-muted">Downloads · 30d</span>
                        </div>
                        <div class="mt-[9px] flex items-baseline gap-1.5">
                            <span class="font-display font-bold text-[26px] tracking-tight text-ink-strong leading-none">12,480</span>
                            <span class="text-[11.5px] font-semibold text-accent-deep">▲ 18%</span>
                        </div>
                        <div class="mt-3 flex items-end gap-[3px] h-10">
                            <span class="flex-1 h-[34%] bg-accent/30 rounded-t-sm"></span><span class="flex-1 h-[46%] bg-accent/30 rounded-t-sm"></span><span class="flex-1 h-[40%] bg-accent/30 rounded-t-sm"></span><span class="flex-1 h-[58%] bg-accent/30 rounded-t-sm"></span><span class="flex-1 h-[52%] bg-accent/30 rounded-t-sm"></span><span class="flex-1 h-[68%] bg-accent/45 rounded-t-sm"></span><span class="flex-1 h-[62%] bg-accent/45 rounded-t-sm"></span><span class="flex-1 h-[82%] bg-accent rounded-t-sm"></span><span class="flex-1 h-[96%] bg-accent rounded-t-sm"></span>
                        </div>
                    </div>
                    <div class="flex-1 bg-white border border-hairline rounded-[18px] p-4" style="box-shadow: 0 16px 32px -30px rgba(20,50,38,0.5);">
                        <div class="font-semibold text-xs text-muted mb-3">Episodes</div>
                        <div class="flex items-center gap-[9px] mb-2.5">
                            <span class="w-4 h-4 rounded-[5px] bg-accent-soft shrink-0"></span>
                            <span class="flex-1 text-xs text-ink font-medium truncate">The honest metric</span>
                            <span class="text-[10.5px] font-semibold text-accent-deep">14</span>
                        </div>
                        <div class="flex items-center gap-[9px] mb-2.5">
                            <span class="w-4 h-4 rounded-[5px] bg-accent-border shrink-0"></span>
                            <span class="flex-1 text-xs text-ink font-medium truncate">Recording at home</span>
                            <span class="text-[10.5px] font-semibold text-accent-deep">13</span>
                        </div>
                        <div class="flex items-center gap-[9px]">
                            <span class="w-4 h-4 rounded-[5px] bg-tint-2/50 shrink-0"></span>
                            <span class="flex-1 text-xs text-ink font-medium truncate">Finding your voice</span>
                            <span class="text-[10.5px] font-semibold text-accent-deep">12</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Hero visual — desktop (floating cards) --}}
            <div class="hidden md:block flex-[1_1_400px] min-w-0">
                <div class="relative w-full max-w-[480px] mx-auto h-[clamp(440px,50vw,520px)]">

                    {{-- Central photo circle --}}
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[312px] h-[312px] rounded-full overflow-hidden" style="box-shadow: 0 30px 60px -36px rgba(20,50,38,0.45);">
                        <img src="{{ asset('images/hero-podcaster-crop.png') }}" alt="Podcaster recording" class="w-full h-full object-cover">
                    </div>

                    {{-- Player card --}}
                    <div class="absolute top-[34px] left-0 w-[226px] bg-white border border-hairline rounded-2xl p-[15px_16px] z-10" style="box-shadow: 0 22px 44px -28px rgba(20,50,38,0.5);">
                        <div class="flex items-center justify-between gap-2">
                            <span class="font-semibold text-[13px] text-muted">Your player</span>
                            <span class="text-[11px] font-semibold text-accent-deep bg-accent-soft rounded-full px-[9px] py-[3px]">Embeddable</span>
                        </div>
                        <div class="mt-3 flex items-center gap-[11px]">
                            <span class="w-9 h-9 rounded-full bg-accent flex items-center justify-center shrink-0"><svg width="14" height="14" viewBox="0 0 24 24" fill="#fff" aria-hidden="true"><path d="M8 5l11 7-11 7z"></path></svg></span>
                            <div class="flex-1 min-w-0">
                                <x-waveform :played="7" :total="14" gap="gap-[3px]" height="h-[24px]" />
                                <div class="flex justify-between mt-[7px] font-mono text-[10px] text-faint"><span>12:04</span><span>38:21</span></div>
                            </div>
                        </div>
                    </div>

                    {{-- Published episodes card --}}
                    <div class="absolute bottom-1 left-0 w-[240px] bg-white border border-hairline rounded-2xl p-[16px_17px] z-10" style="box-shadow: 0 22px 44px -28px rgba(20,50,38,0.5);">
                        <div class="font-semibold text-[13px] text-muted mb-[13px]">Published episodes</div>
                        <div class="flex items-center gap-2.5 mb-[11px]">
                            <span class="w-[18px] h-[18px] rounded-md bg-accent-soft shrink-0"></span>
                            <span class="flex-1 text-[13px] text-ink font-medium">The honest metric</span>
                            <span class="text-[11px] font-semibold text-accent-deep">Ep 14</span>
                        </div>
                        <div class="flex items-center gap-2.5 mb-[11px]">
                            <span class="w-[18px] h-[18px] rounded-md bg-accent-border shrink-0"></span>
                            <span class="flex-1 text-[13px] text-ink font-medium">Recording at home</span>
                            <span class="text-[11px] font-semibold text-accent-deep">Ep 13</span>
                        </div>
                        <div class="flex items-center gap-2.5">
                            <span class="w-[18px] h-[18px] rounded-md bg-tint-2/50 shrink-0"></span>
                            <span class="flex-1 text-[13px] text-ink font-medium">Finding your voice</span>
                            <span class="text-[11px] font-semibold text-accent-deep">Ep 12</span>
                        </div>
                    </div>

                    {{-- Analytics box --}}
                    <div class="absolute top-[40%] -right-10 w-[184px] bg-white border border-hairline rounded-2xl p-[15px_16px] z-10" style="box-shadow: 0 22px 44px -28px rgba(20,50,38,0.5);">
                        <div class="flex items-center gap-[7px]">
                            <span class="w-[7px] h-[7px] rounded-full bg-accent inline-block"></span>
                            <span class="font-semibold text-xs text-muted">Downloads · 30d</span>
                        </div>
                        <div class="mt-[9px] flex items-baseline gap-[7px]">
                            <span class="font-display font-bold text-[30px] tracking-tight text-ink-strong leading-none">12,480</span>
                            <span class="text-xs font-semibold text-accent-deep">▲ 18%</span>
                        </div>
                        <div class="mt-3 flex items-end gap-[3px] h-[38px]">
                            <span class="flex-1 h-[34%] bg-accent/30 rounded-t-sm"></span><span class="flex-1 h-[46%] bg-accent/30 rounded-t-sm"></span><span class="flex-1 h-[40%] bg-accent/30 rounded-t-sm"></span><span class="flex-1 h-[58%] bg-accent/30 rounded-t-sm"></span><span class="flex-1 h-[52%] bg-accent/30 rounded-t-sm"></span><span class="flex-1 h-[68%] bg-accent/45 rounded-t-sm"></span><span class="flex-1 h-[62%] bg-accent/45 rounded-t-sm"></span><span class="flex-1 h-[82%] bg-accent rounded-t-sm"></span><span class="flex-1 h-[96%] bg-accent rounded-t-sm"></span>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

    {{-- ============ PROBLEM ============ --}}
    <section class="py-[clamp(56px,9vw,104px)]">
        <div class="max-w-[1160px] mx-auto px-[clamp(20px,5vw,40px)]">
            <h2 class="font-display font-semibold text-[clamp(28px,4.4vw,46px)] leading-[1.08] tracking-[-0.02em] max-w-[16em]" style="text-wrap: balance;">
                Most podcast hosting wastes your time before you've even hit publish.
            </h2>
            <div class="mt-[clamp(36px,5vw,56px)] grid grid-cols-[repeat(auto-fit,minmax(240px,1fr))] gap-[clamp(24px,4vw,44px)]">
                <div class="border-t-2 border-hairline-strong pt-[18px]">
                    <p class="text-lg leading-normal text-[#3c3b35]">Confusing upload flows that take longer than recording did.</p>
                </div>
                <div class="border-t-2 border-hairline-strong pt-[18px]">
                    <p class="text-lg leading-normal text-[#3c3b35]">Storage limits that bite right when an episode finally takes off.</p>
                </div>
                <div class="border-t-2 border-hairline-strong pt-[18px]">
                    <p class="text-lg leading-normal text-[#3c3b35]">Pricing pages that need a calculator.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============ OFFERS ============ --}}
    <section class="py-[clamp(40px,6vw,72px)]">
        <div class="max-w-[1160px] mx-auto px-[clamp(20px,5vw,40px)]">
            <div class="max-w-[34em]">
                <h2 class="font-display font-semibold text-[clamp(28px,4.4vw,46px)] leading-[1.08] tracking-[-0.02em]" style="text-wrap: balance;">Everything you need. Nothing you don't.</h2>
                <p class="text-lg leading-[1.55] text-muted mt-4">Six things we're getting right from day one.</p>
            </div>

            <div class="mt-[clamp(36px,5vw,56px)] grid grid-cols-[repeat(auto-fit,minmax(300px,1fr))] gap-[18px]">

                @php
                    $features = [
                        ['icon' => '<path d="M12 16V5"></path><path d="M7 10l5-5 5 5"></path><path d="M5 19h14"></path>', 'title' => 'Publish in minutes', 'desc' => 'Upload your episode and your RSS feed is ready. No configuration rabbit holes.'],
                        ['icon' => '<path d="M5 19V13"></path><path d="M12 19V8"></path><path d="M19 19V11"></path>', 'title' => 'Analytics that make sense', 'desc' => 'See your downloads and where your listeners are - presented clearly.'],
                        ['icon' => '<circle cx="12" cy="12" r="8"></circle><path d="M8.5 12h7"></path>', 'title' => 'Honest pricing', 'desc' => 'Three simple tiers. Generous storage and bandwidth. No surprise overages.'],
                        ['icon' => '<rect x="3" y="5" width="18" height="14" rx="2.5"></rect><path d="M3 9.5h18"></path>', 'title' => 'Your podcast website', 'desc' => 'A custom show website that looks good straight out of the box. No design work, no extra tools.'],
                        ['icon' => '<circle cx="12" cy="12" r="8"></circle><path d="M10 9l5 3-5 3z"></path>', 'title' => 'A player you can embed', 'desc' => 'Drop a customisable player into any site or blog post - your branding, your colours.'],
                        ['icon' => '<rect x="7" y="3" width="10" height="18" rx="2.5"></rect><path d="M10.5 18h3"></path>', 'title' => 'Manage from anywhere', 'desc' => 'The dashboard is built for your phone too. Check downloads or publish an episode on the move.'],
                    ];
                @endphp

                @foreach ($features as $feature)
                    <div class="bg-white border border-hairline rounded-[18px] p-[22px] md:p-7">
                        <div class="flex items-center gap-3.5 md:block">
                            <div class="w-[46px] h-[46px] md:w-[54px] md:h-[54px] rounded-[13px] md:rounded-[14px] bg-accent-soft flex items-center justify-center shrink-0">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0a6b4a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" class="md:w-[26px] md:h-[26px]">{!! $feature['icon'] !!}</svg>
                            </div>
                            <h3 class="font-display font-semibold text-lg md:text-xl md:mt-5 mb-0 md:mb-2 tracking-tight">{{ $feature['title'] }}</h3>
                        </div>
                        <p class="text-[15px] md:text-base leading-normal text-muted mt-[13px] md:mt-0">{{ $feature['desc'] }}</p>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- ============ PRICING ============ --}}
    <section class="py-[clamp(48px,7vw,88px)]">
        <div class="max-w-[1160px] mx-auto px-[clamp(20px,5vw,40px)]">
            <div class="max-w-[34em]">
                <h2 class="font-display font-semibold text-[clamp(28px,4.4vw,46px)] leading-[1.08] tracking-[-0.02em]" style="text-wrap: balance;">Fair from the first episode.</h2>
                <p class="text-lg leading-[1.55] text-muted mt-4" style="text-wrap: pretty;">Generous storage and bandwidth included on every plan, with no surprise overages.</p>
            </div>

            <div class="mt-[clamp(28px,5vw,56px)] flex flex-col md:grid md:grid-cols-[repeat(auto-fit,minmax(260px,1fr))] gap-3.5 md:gap-[18px] md:items-stretch">

                <div class="bg-white border border-hairline rounded-[20px] p-6 md:p-[30px]">
                    <div class="font-display font-semibold text-sm md:text-[15px] text-muted tracking-[0.01em]">Free</div>
                    <div class="flex items-baseline gap-1.5 mt-3"><span class="font-display font-bold text-[40px] md:text-[44px] tracking-tight">&pound;0</span><span class="text-sm md:text-[15px] text-faint">/ forever</span></div>
                    <p class="mt-3.5 text-[14.5px] md:text-[15px] leading-normal text-muted">Get your show live and listed everywhere podcasts are played. No card needed.</p>
                </div>

                <div class="bg-accent-soft border-[1.5px] border-accent rounded-[20px] p-6 md:p-[30px] relative">
                    <span class="absolute -top-3 left-6 md:left-[30px] bg-accent text-white text-[11.5px] md:text-xs font-semibold tracking-wide rounded-full px-3 py-[5px]">Ideal for most shows</span>
                    <div class="font-display font-semibold text-sm md:text-[15px] text-accent-deep tracking-[0.01em]">Pro</div>
                    <div class="flex items-baseline gap-1.5 mt-3"><span class="font-display font-bold text-[40px] md:text-[44px] tracking-tight text-ink-strong">&pound;10</span><span class="text-sm md:text-[15px] text-on-soft-muted">/ month</span></div>
                    <p class="mt-3.5 text-[14.5px] md:text-[15px] leading-normal text-on-soft">For shows building an audience, with more storage and the full download dashboard.</p>
                    <p class="mt-3.5 text-[13px] leading-normal text-on-soft">Paid annually. &pound;12/month when paid monthly.</p>
                </div>

                <div class="bg-white border border-hairline rounded-[20px] p-6 md:p-[30px]">
                    <div class="font-display font-semibold text-sm md:text-[15px] text-muted tracking-[0.01em]">Studio</div>
                    <div class="flex items-baseline gap-1.5 mt-3"><span class="text-sm md:text-[15px] text-faint">from</span><span class="font-display font-bold text-[40px] md:text-[44px] tracking-tight">&pound;30</span><span class="text-sm md:text-[15px] text-faint">/ month</span></div>
                    <p class="mt-3.5 text-[14.5px] md:text-[15px] leading-normal text-muted">For teams and multi-show studios, with shared access and priority support.</p>
                    <p class="mt-3.5 text-[13px] leading-normal text-muted">Paid annually. &pound;36/month when paid monthly.</p>
                </div>

            </div>
        </div>
    </section>

    {{-- ============ SECOND CTA ============ --}}
    <section id="join" class="py-[clamp(40px,6vw,72px)]">
        <div class="max-w-[1160px] mx-auto px-[clamp(20px,5vw,40px)]">
            <div class="bg-accent-soft rounded-[24px] md:rounded-[28px] px-6 md:px-[clamp(24px,5vw,56px)] py-9 md:py-[clamp(40px,7vw,80px)] text-center">
                <h2 class="font-display font-bold text-[30px] md:text-[clamp(30px,4.6vw,50px)] leading-[1.08] md:leading-[1.05] tracking-[-0.025em]" style="text-wrap: balance;">Be first through the door.</h2>
                <p class="text-base md:text-[clamp(16px,2vw,19px)] leading-[1.55] text-on-soft mt-3.5 md:mt-[18px] mx-auto max-w-[30em]">Join the waitlist and we'll send a single email the day we launch. No spam, ever.</p>

                <div class="mt-6 md:mt-[30px] mx-auto max-w-[480px]">
                    @if (session('waitlist_success'))
                        <div class="inline-flex items-center gap-3 bg-white border border-accent-border rounded-[14px] px-4 md:px-[22px] py-4">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0a6b4a" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 13l4 4L19 7"></path></svg>
                            <span class="text-[15px] md:text-base font-medium text-accent-deep">You're on the list. We'll send you occasional emails between now and launch.</span>
                        </div>
                    @else
                        <form action="{{ route('waitlist.store') }}" method="POST" class="flex flex-col md:flex-row gap-2.5 md:justify-center">
                            @csrf
                            <input type="text" name="website" class="!absolute !-left-[9999px] !h-0 !w-0 !overflow-hidden" tabindex="-1" autocomplete="off" aria-hidden="true">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="you@yourshow.com" aria-label="Email address" required class="w-full md:flex-[1_1_220px] min-w-0 h-[52px] md:h-[54px] border border-accent-border-2 rounded-[13px] px-4 font-body text-base bg-white text-ink outline-none transition-all focus:border-accent focus:ring-[3px] focus:ring-accent/18 text-center md:text-left">
                            <button type="submit" class="w-full md:w-auto bg-accent text-white border-none rounded-[13px] px-6 h-[52px] md:h-[54px] font-body font-semibold text-base cursor-pointer whitespace-nowrap transition-all hover:bg-accent-hover hover:-translate-y-px">Join the waitlist</button>
                        </form>
                        @error('email')
                            <p class="mt-2.5 text-sm text-danger">{{ $message }}</p>
                        @enderror
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- ============ FOOTER ============ --}}
    <footer class="py-8 md:py-[clamp(40px,5vw,64px)] pb-10 md:pb-[clamp(48px,5vw,72px)] border-t border-[#e8e5da] mt-[clamp(24px,4vw,48px)]">
        <div class="max-w-[1160px] mx-auto px-5 md:px-[clamp(20px,5vw,40px)] flex flex-wrap gap-6 items-center justify-between">
            <div class="flex items-center gap-2.5">
                <svg width="20" height="20" viewBox="0 0 22 22" aria-hidden="true"><rect x="2" y="8" width="3.4" height="6" rx="1.7" fill="#0e9d6e"></rect><rect x="9.3" y="3" width="3.4" height="16" rx="1.7" fill="#0e9d6e"></rect><rect x="16.6" y="6" width="3.4" height="10" rx="1.7" fill="#15110d"></rect></svg>
                <span class="font-display font-bold text-base">Podcast Bounce</span>
                <span class="text-sm text-faint ml-1">&bull; Coming soon 2026</span>
            </div>
            {{-- <div class="flex items-center gap-[22px]">
                <a href="#" class="text-muted text-sm font-medium hover:text-accent transition-colors no-underline">@podcastbounce</a>
                <span class="text-sm text-faint">We'll only email you about launch.</span>
            </div> --}}
        </div>
    </footer>

</body>
</html>
