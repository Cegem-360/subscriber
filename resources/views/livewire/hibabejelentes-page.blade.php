<div x-data="{
    priority: 'normal',
    countersAnimated: false,
    animateCounters() {
        if (this.countersAnimated) return;
        this.countersAnimated = true;
        this.$root.querySelectorAll('[data-count]').forEach(el => {
            const target = el.dataset.count;
            const isPrefix = el.dataset.prefix || '';
            const isSuffix = el.dataset.suffix || '';
            const duration = 1500;
            const steps = 40;
            const stepTime = duration / steps;
            const isNumber = !isNaN(parseFloat(target));

            if (isNumber) {
                const end = parseFloat(target);
                let current = 0;
                const increment = end / steps;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= end) {
                        current = end;
                        clearInterval(timer);
                    }
                    el.textContent = isPrefix + (Number.isInteger(end) ? Math.round(current) : current.toFixed(0)) + isSuffix;
                }, stepTime);
            } else {
                el.textContent = isPrefix + target + isSuffix;
            }
        });
    }
}" x-init="
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('revealed');
                if (entry.target.hasAttribute('data-stagger')) {
                    entry.target.querySelectorAll('.stagger-item').forEach((child, i) => {
                        setTimeout(() => child.classList.add('revealed'), i * 80);
                    });
                }
                if (entry.target.hasAttribute('data-counter-trigger')) {
                    animateCounters();
                }
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -60px 0px' });

    $root.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, [data-stagger], [data-counter-trigger]').forEach(el => observer.observe(el));
">

    {{-- Scoped Animation Styles --}}
    <style>
        .reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.7s cubic-bezier(0,0,0.2,1), transform 0.7s cubic-bezier(0,0,0.2,1); }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-left { opacity: 0; transform: translateX(-32px); transition: opacity 0.7s cubic-bezier(0,0,0.2,1), transform 0.7s cubic-bezier(0,0,0.2,1); }
        .reveal-left.revealed { opacity: 1; transform: translateX(0); }
        .reveal-right { opacity: 0; transform: translateX(32px); transition: opacity 0.7s cubic-bezier(0,0,0.2,1), transform 0.7s cubic-bezier(0,0,0.2,1); }
        .reveal-right.revealed { opacity: 1; transform: translateX(0); }
        .reveal-scale { opacity: 0; transform: scale(0.92); transition: opacity 0.6s cubic-bezier(0,0,0.2,1), transform 0.6s cubic-bezier(0,0,0.2,1); }
        .reveal-scale.revealed { opacity: 1; transform: scale(1); }
        .stagger-item { opacity: 0; transform: translateY(20px); transition: opacity 0.5s cubic-bezier(0,0,0.2,1), transform 0.5s cubic-bezier(0,0,0.2,1); }
        .stagger-item.revealed { opacity: 1; transform: translateY(0); }

        @keyframes gradient-shift { 0%, 100% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } }
        .badge-gradient { background-size: 200% 200%; animation: gradient-shift 3s ease infinite; }

        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(0, 202, 114, 0.4); }
            70% { box-shadow: 0 0 0 6px rgba(0, 202, 114, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 202, 114, 0); }
        }
        .pulse-dot { animation: pulse-ring 2s ease infinite; }

        .card-glow { transition: all 0.4s cubic-bezier(0,0,0.2,1); }
        .card-glow:hover { box-shadow: 0 8px 30px -8px rgba(251, 39, 93, 0.12), 0 2px 8px rgba(0,0,0,0.04) !important; }

        .icon-hover { transition: transform 0.35s cubic-bezier(0,0,0.2,1.4); }
        .group:hover .icon-hover, .card-glow:hover .icon-hover { transform: translateY(-3px) scale(1.08); }

        .arrow-slide { transition: transform 0.3s cubic-bezier(0,0,0.2,1); }
        .group:hover .arrow-slide, a:hover .arrow-slide { transform: translateX(4px); }

        .stat-hover .stat-value { transition: transform 0.4s cubic-bezier(0,0,0.2,1.4); }
        .stat-hover:hover .stat-value { transform: scale(1.08); }

        html { scroll-behavior: smooth; }
    </style>

    {{-- Hero Section --}}
    <section class="bg-linear-to-b from-danger-50 to-surface-secondary">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:py-24">
            <div class="reveal mx-auto max-w-3xl text-center">
                <div class="badge-gradient mb-8 inline-flex items-center gap-2 rounded-full border border-border-light/80 bg-surface-primary px-4 py-1.5"
                    style="box-shadow: 0 1px 3px rgba(0,0,0,0.04);">
                    <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-linear-to-r from-danger-500 via-danger-400 to-danger-300"></span>
                    <span class="text-sm font-medium text-text-primary">Hibabejelentes</span>
                </div>

                <h1 class="mb-6 text-4xl leading-tight tracking-tight text-text-primary md:text-5xl lg:text-[3.5rem]"
                    style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    Technikai problema jelzese<br>
                    a Cegem360 csapatnak
                </h1>

                <p class="mx-auto mb-10 max-w-2xl text-lg text-text-secondary lg:text-xl">
                    Toltse ki az alabbi urlapot a hiba reszleteivel — minel pontosabb a leiras, annal gyorsabban tudunk segiteni. A csapatunk hetfo–pentek 8:00–16:00 kozott kezeli a bejelenteseket.
                </p>

                <div class="flex flex-wrap items-center justify-center gap-6">
                    <div class="flex items-center gap-2">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-success-50 text-sm">&#9201;</span>
                        <span class="text-sm text-text-secondary"><strong class="text-text-primary">1–8 ora</strong> valaszido</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary-50 text-sm">&#128197;</span>
                        <span class="text-sm text-text-secondary"><strong class="text-text-primary">H–P 8–16h</strong> kezeles</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-warning-50 text-sm">&#128231;</span>
                        <span class="text-sm text-text-secondary"><strong class="text-text-primary">E-mail ertesites</strong> a statuszrol</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Form + Sidebar Section --}}
    <section class="bg-surface-secondary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid grid-cols-1 items-start gap-8 lg:grid-cols-[1fr_360px]">

                {{-- Form --}}
                <div class="reveal rounded-2xl border border-border-light bg-surface-primary p-8 lg:p-10" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <h2 class="mb-1 text-xl font-bold text-text-primary" style="font-family: 'Poppins', sans-serif;">Hibabejelento urlap</h2>
                    <p class="mb-8 text-sm text-text-tertiary">A *-gal jelolt mezok kitoltese kotelezo.</p>

                    <form id="bugForm">

                        {{-- Bejelento adatai --}}
                        <p class="mb-5 text-xs font-bold uppercase tracking-widest text-danger-600">Bejelento adatai</p>

                        <div class="mb-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label for="name" class="mb-2 block text-sm font-semibold text-text-primary">Nev <span class="text-danger-500">*</span></label>
                                <input type="text" id="name" name="name" class="input" placeholder="Teljes nev" required>
                            </div>
                            <div>
                                <label for="email" class="mb-2 block text-sm font-semibold text-text-primary">E-mail cim <span class="text-danger-500">*</span></label>
                                <input type="email" id="email" name="email" class="input" placeholder="nev@ceg.hu" required>
                            </div>
                        </div>

                        <div class="mb-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label for="company" class="mb-2 block text-sm font-semibold text-text-primary">Cegnev <span class="text-danger-500">*</span></label>
                                <input type="text" id="company" name="company" class="input" placeholder="Ceg neve" required>
                            </div>
                            <div>
                                <label for="phone" class="mb-2 block text-sm font-semibold text-text-primary">Telefonszam</label>
                                <input type="tel" id="phone" name="phone" class="input" placeholder="+36 ...">
                                <span class="mt-1 block text-xs text-text-tertiary">Opcionalis — ha surgos visszahivast ker</span>
                            </div>
                        </div>

                        <div class="my-8 h-px bg-border-light"></div>

                        {{-- Hiba reszletei --}}
                        <p class="mb-5 text-xs font-bold uppercase tracking-widest text-danger-600">Hiba reszletei</p>

                        <div class="mb-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label for="module" class="mb-2 block text-sm font-semibold text-text-primary">Erintett modul <span class="text-danger-500">*</span></label>
                                <select id="module" name="module" class="input" required>
                                    <option value="" disabled selected>Valasszon modult&hellip;</option>
                                    <option value="crm">CRM &amp; Ugyfelkezeles</option>
                                    <option value="ertekesites">Ertekesites</option>
                                    <option value="gyartasiranyitas">Gyartasiranyitas</option>
                                    <option value="beszerzes">Beszerzes-logisztika</option>
                                    <option value="munkalap">Digitalis munkalap</option>
                                    <option value="kontrolling">Kontrolling</option>
                                    <option value="automatizalas">Automatizalas</option>
                                    <option value="datamind">DataMind (MI)</option>
                                    <option value="marketinghub">MarketingHub</option>
                                    <option value="seo">SEO modul</option>
                                    <option value="aichat">AI Chat</option>
                                    <option value="dokumentumok">Dokumentumok</option>
                                    <option value="iranyitopult">Iranyitopultok</option>
                                    <option value="ugyfelportal">Ugyfelportal</option>
                                    <option value="bejelentkezes">Bejelentkezes / Fiok</option>
                                    <option value="egyeb">Egyeb / nem tudom</option>
                                </select>
                            </div>
                            <div>
                                <label for="issue-type" class="mb-2 block text-sm font-semibold text-text-primary">Hiba tipusa <span class="text-danger-500">*</span></label>
                                <select id="issue-type" name="issue_type" class="input" required>
                                    <option value="" disabled selected>Valasszon tipust&hellip;</option>
                                    <option value="nem-mukodik">Funkcio nem mukodik</option>
                                    <option value="hibauzenet">Hibauzenet jelenik meg</option>
                                    <option value="lassu">Lassu mukodes / teljesitmeny</option>
                                    <option value="nem-jelenik-meg">Adat nem jelenik meg</option>
                                    <option value="rossz-adat">Hibas adat / szamitas</option>
                                    <option value="jogosultsag">Jogosultsagi problema</option>
                                    <option value="integracio">Integracios hiba</option>
                                    <option value="dokumentum">Dokumentum-generalas hiba</option>
                                    <option value="egyeb-hiba">Egyeb</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-5">
                            <label for="subject" class="mb-2 block text-sm font-semibold text-text-primary">Rovid osszefoglalo <span class="text-danger-500">*</span></label>
                            <input type="text" id="subject" name="subject" class="input" placeholder="Pl.: CRM-ben az ajanlat PDF export hibauzenet ad" required>
                            <span class="mt-1 block text-xs text-text-tertiary">Egy mondat, ami osszefoglalja a problemat</span>
                        </div>

                        <div class="mb-5">
                            <label for="description" class="mb-2 block text-sm font-semibold text-text-primary">Reszletes leiras <span class="text-danger-500">*</span></label>
                            <textarea id="description" name="description" class="input" rows="6" placeholder="Kerjuk, irja le reszletesen:&#10;&#10;1. Mit csinalt, amikor a hiba felmerult?&#10;2. Milyen hibauzenet kapott (ha volt)?&#10;3. A hiba ismetlodik-e, vagy egyszeri?&#10;4. Miota tapasztalja?" required style="resize: vertical; min-height: 140px;"></textarea>
                            <span class="mt-1 block text-xs text-text-tertiary">Minel reszletesebb, annal gyorsabban tudunk segiteni</span>
                        </div>

                        <div class="mb-5 grid grid-cols-1 gap-5 sm:grid-cols-2">
                            <div>
                                <label for="url" class="mb-2 block text-sm font-semibold text-text-primary">Erintett oldal URL-je</label>
                                <input type="url" id="url" name="url" class="input" placeholder="https://cegem360.eu/admin/...">
                                <span class="mt-1 block text-xs text-text-tertiary">Masolja be a bongeszo cimsorabol</span>
                            </div>
                            <div>
                                <label for="browser" class="mb-2 block text-sm font-semibold text-text-primary">Bongeszo es eszkoz</label>
                                <select id="browser" name="browser" class="input">
                                    <option value="" disabled selected>Valasszon&hellip;</option>
                                    <option value="chrome-desktop">Chrome — Asztali</option>
                                    <option value="chrome-mobile">Chrome — Mobil</option>
                                    <option value="firefox-desktop">Firefox — Asztali</option>
                                    <option value="safari-desktop">Safari — Asztali</option>
                                    <option value="safari-mobile">Safari — Mobil (iPhone/iPad)</option>
                                    <option value="edge-desktop">Edge — Asztali</option>
                                    <option value="egyeb-bongeszo">Egyeb</option>
                                </select>
                            </div>
                        </div>

                        <div class="my-8 h-px bg-border-light"></div>

                        {{-- Prioritas --}}
                        <p class="mb-5 text-xs font-bold uppercase tracking-widest text-danger-600">Prioritas <span class="text-danger-500">*</span></p>

                        <div class="mb-5 grid grid-cols-2 gap-3 sm:grid-cols-4">
                            <label class="cursor-pointer rounded-xl border p-4 text-center transition-all"
                                :class="priority === 'critical' ? 'border-danger-400 bg-danger-50' : 'border-border-light bg-surface-secondary hover:border-border-default'"
                                @click="priority = 'critical'">
                                <input type="radio" name="priority" value="critical" class="hidden" x-model="priority">
                                <span class="mb-1 block text-lg">&#128308;</span>
                                <span class="block text-xs font-bold text-text-primary">Kritikus</span>
                                <span class="block text-[10px] text-text-tertiary">Rendszer nem elerheto</span>
                            </label>
                            <label class="cursor-pointer rounded-xl border p-4 text-center transition-all"
                                :class="priority === 'high' ? 'border-orange-400 bg-orange-50' : 'border-border-light bg-surface-secondary hover:border-border-default'"
                                @click="priority = 'high'">
                                <input type="radio" name="priority" value="high" class="hidden" x-model="priority">
                                <span class="mb-1 block text-lg">&#128992;</span>
                                <span class="block text-xs font-bold text-text-primary">Magas</span>
                                <span class="block text-[10px] text-text-tertiary">Funkcio nem mukodik</span>
                            </label>
                            <label class="cursor-pointer rounded-xl border p-4 text-center transition-all"
                                :class="priority === 'normal' ? 'border-warning-400 bg-warning-50' : 'border-border-light bg-surface-secondary hover:border-border-default'"
                                @click="priority = 'normal'">
                                <input type="radio" name="priority" value="normal" class="hidden" x-model="priority">
                                <span class="mb-1 block text-lg">&#128993;</span>
                                <span class="block text-xs font-bold text-text-primary">Normal</span>
                                <span class="block text-[10px] text-text-tertiary">Zavaro, de van workaround</span>
                            </label>
                            <label class="cursor-pointer rounded-xl border p-4 text-center transition-all"
                                :class="priority === 'low' ? 'border-blue-400 bg-blue-50' : 'border-border-light bg-surface-secondary hover:border-border-default'"
                                @click="priority = 'low'">
                                <input type="radio" name="priority" value="low" class="hidden" x-model="priority">
                                <span class="mb-1 block text-lg">&#128309;</span>
                                <span class="block text-xs font-bold text-text-primary">Alacsony</span>
                                <span class="block text-[10px] text-text-tertiary">Kozmetikai / javaslat</span>
                            </label>
                        </div>

                        <div class="my-8 h-px bg-border-light"></div>

                        {{-- Kepernykep / csatolmany --}}
                        <p class="mb-5 text-xs font-bold uppercase tracking-widest text-danger-600">Kepernykep / csatolmany</p>

                        <div class="mb-5">
                            <label for="attachment" class="relative flex cursor-pointer flex-col items-center rounded-xl border-2 border-dashed border-border-light bg-surface-secondary p-8 text-center transition-all hover:border-border-default hover:bg-surface-tertiary">
                                <input type="file" id="attachment" name="attachment" accept="image/*,.pdf,.zip,.doc,.docx" multiple class="absolute inset-0 cursor-pointer opacity-0">
                                <span class="mb-2 block text-2xl">&#128206;</span>
                                <span class="block text-sm text-text-secondary">Huzza ide a fajlokat, vagy kattintson a tallozashoz</span>
                                <span class="mt-1 block text-xs text-text-tertiary">Formatumok: PNG, JPG, PDF, ZIP, DOC &middot; Max. 10 MB / fajl &middot; Max. 5 fajl</span>
                            </label>
                            <span class="mt-1 block text-xs text-text-tertiary">Kepernykep(ek) csatolasa jelentosen gyorsitja a hibaelharitast</span>
                        </div>

                        <div class="my-8 h-px bg-border-light"></div>

                        {{-- Hozzajarulas --}}
                        <div class="mb-4">
                            <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-border-light bg-surface-secondary p-4 transition-all hover:border-border-default">
                                <input type="checkbox" name="consent" required class="mt-0.5 h-4 w-4 shrink-0 rounded border-border-default text-danger-500 focus:ring-danger-300">
                                <span class="text-sm text-text-secondary">Hozzajarulok, hogy a Cegem 360 Kft. a megadott adataimat a hibabejelentes kezelesehez felhasznaja az <a href="{{ route('legal.adatvedelmi-tajekoztato') }}" target="_blank" class="font-semibold text-danger-600 hover:text-danger-700">Adatvedelmi tajekoztato</a> szerint. <span class="text-danger-500">*</span></span>
                            </label>
                        </div>

                        <div class="mb-6">
                            <label class="flex cursor-pointer items-start gap-3 rounded-xl border border-border-light bg-surface-secondary p-4 transition-all hover:border-border-default">
                                <input type="checkbox" name="notify" checked class="mt-0.5 h-4 w-4 shrink-0 rounded border-border-default text-danger-500 focus:ring-danger-300">
                                <span class="text-sm text-text-secondary">Kerem az e-mail ertesitest a hibabejelentes statuszvaltozoasairol.</span>
                            </label>
                        </div>

                        {{-- Submit --}}
                        <button type="submit" id="bugSubmitBtn"
                            class="group flex w-full items-center justify-center gap-2 rounded-xl bg-danger-600 px-6 py-4 text-base font-bold text-white transition-all hover:bg-danger-700 hover:shadow-lg"
                            style="box-shadow: 0 4px 24px rgba(251, 39, 93, 0.2);">
                            Hibabejelentes elkuldese
                            <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </button>
                    </form>
                </div>

                {{-- Sidebar --}}
                <div class="reveal-right flex flex-col gap-5 lg:sticky lg:top-24">

                    {{-- System Status --}}
                    <div class="rounded-2xl border border-success-200 bg-success-50/50 p-5" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <div class="flex items-center gap-3">
                            <span class="pulse-dot h-2.5 w-2.5 shrink-0 rounded-full bg-success-500"></span>
                            <span class="text-sm text-text-secondary">A Cegem360 rendszer <strong class="text-success-700">jelenleg elerheto</strong> es normalisan mukodik.</span>
                        </div>
                    </div>

                    {{-- SLA --}}
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <h3 class="mb-4 flex items-center gap-2 text-base font-bold text-text-primary">
                            <span class="text-sm">&#9201;</span> Valaszidok prioritas szerint
                        </h3>
                        <div class="space-y-2">
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-2.5">
                                <span class="flex items-center gap-2 text-sm text-text-secondary">
                                    <span class="h-1.5 w-1.5 rounded-full bg-danger-500"></span> Kritikus
                                </span>
                                <span class="text-sm font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">&lt; 1 ora</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-2.5">
                                <span class="flex items-center gap-2 text-sm text-text-secondary">
                                    <span class="h-1.5 w-1.5 rounded-full bg-orange-500"></span> Magas
                                </span>
                                <span class="text-sm font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">&lt; 4 ora</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-2.5">
                                <span class="flex items-center gap-2 text-sm text-text-secondary">
                                    <span class="h-1.5 w-1.5 rounded-full bg-warning-500"></span> Normal
                                </span>
                                <span class="text-sm font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">&lt; 8 ora</span>
                            </div>
                            <div class="flex items-center justify-between rounded-lg bg-surface-secondary px-4 py-2.5">
                                <span class="flex items-center gap-2 text-sm text-text-secondary">
                                    <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span> Alacsony
                                </span>
                                <span class="text-sm font-bold text-text-primary" style="font-family: 'JetBrains Mono', monospace;">&lt; 24 ora</span>
                            </div>
                        </div>
                    </div>

                    {{-- Tips --}}
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <h3 class="mb-4 flex items-center gap-2 text-base font-bold text-text-primary">
                            <span class="text-sm">&#128161;</span> Tippek a gyorsabb megoldashoz
                        </h3>
                        <div class="space-y-3">
                            <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                                <span class="mt-0.5 flex-shrink-0 text-xs">&#128161;</span>
                                Csatoljon kepernykepet — a vizualis informacio sokat segit.
                            </p>
                            <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                                <span class="mt-0.5 flex-shrink-0 text-xs">&#128161;</span>
                                Masolja be a hibauzenet pontos szoveget a leirasba.
                            </p>
                            <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                                <span class="mt-0.5 flex-shrink-0 text-xs">&#128161;</span>
                                Jelezze, hogy a hiba ismetlodik-e vagy egyszeri.
                            </p>
                            <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                                <span class="mt-0.5 flex-shrink-0 text-xs">&#128161;</span>
                                Adja meg a bongeszot es az eszkozt (asztali/mobil).
                            </p>
                            <p class="flex items-start gap-2.5 text-sm text-text-secondary">
                                <span class="mt-0.5 flex-shrink-0 text-xs">&#128161;</span>
                                Ha a hiba egy adott felhasznalohoz kotodik, jelezze a felhasznalonevet.
                            </p>
                        </div>
                    </div>

                    {{-- Other channels --}}
                    <div class="rounded-2xl border border-border-light bg-surface-primary p-6" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                        <h3 class="mb-4 flex items-center gap-2 text-base font-bold text-text-primary">
                            <span class="text-sm">&#128222;</span> Egyeb elerhetosegek
                        </h3>
                        <div class="space-y-2.5">
                            <div class="flex items-center gap-3 rounded-lg border border-border-light bg-surface-secondary p-3 transition-all hover:border-border-default">
                                <span class="text-base">&#129302;</span>
                                <div>
                                    <span class="block text-sm font-bold text-text-primary">AI Chat</span>
                                    <span class="block text-[11px] text-text-tertiary">24/7 &middot; Azonnali valasz a rendszerben</span>
                                </div>
                            </div>
                            <a href="mailto:support@cegem360.eu" class="flex items-center gap-3 rounded-lg border border-border-light bg-surface-secondary p-3 transition-all hover:border-border-default">
                                <span class="text-base">&#128231;</span>
                                <div>
                                    <span class="block text-sm font-bold text-text-primary">support@cegem360.eu</span>
                                    <span class="block text-[11px] text-text-tertiary">H–P 8–16h &middot; Valasz &lt; 4 ora</span>
                                </div>
                            </a>
                            <a href="{{ route('tamogatas') }}" class="flex items-center gap-3 rounded-lg border border-border-light bg-surface-secondary p-3 transition-all hover:border-border-default">
                                <span class="text-base">&#128218;</span>
                                <div>
                                    <span class="block text-sm font-bold text-text-primary">24/7 Tamogatas oldal</span>
                                    <span class="block text-[11px] text-text-tertiary">Osszes elerhetoseg es AI Chat</span>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- After Form: 3 Steps Section --}}
    <section class="bg-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal mb-12 text-center">
                <p class="mb-2 text-xs font-semibold uppercase tracking-widest text-danger-600">Mi tortenik a bejelentes utan?</p>
                <h2 class="text-3xl text-text-primary md:text-4xl" style="font-family: 'Poppins', sans-serif; font-weight: 400;">
                    3 lepesben a megoldasig
                </h2>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-3" data-stagger>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">&#128232;</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">1. Visszaigazolas azonnal</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A bejelentes elkuldese utan automatikus e-mailt kap a jegy-szammal es a varhato valaszidovel. A jegyet barmikor kovetheti.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">&#128269;</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">2. Vizsgalat es diagnozis</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A csapatunk megvizsgalja a problemat, szukseg eseten kerdez vissza, es elkezdi a javitast. A statusz e-mailben kovetheto.</p>
                </div>
                <div class="stagger-item card-glow rounded-2xl border border-border-light bg-surface-primary p-8 text-center" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div class="icon-hover mb-4 text-3xl">&#10004;</div>
                    <h3 class="mb-2 text-lg font-bold text-text-primary">3. Megoldas es lezaras</h3>
                    <p class="text-sm leading-relaxed text-text-secondary">A megoldasrol ertesitjuk — a javitas leirasaval egyutt. Elegedettsegi kerdest kuldunk, es a jegyet lezarjuk.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer CTA Section --}}
    <section class="bg-linear-to-b from-surface-secondary to-surface-primary py-16 lg:py-24">
        <div class="mx-auto max-w-7xl px-6">
            <div class="reveal">
                <div class="grid grid-cols-1 items-center gap-8 rounded-2xl border border-border-light bg-surface-primary p-8 lg:grid-cols-[1fr_auto] lg:p-12" style="box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                    <div>
                        <h3 class="mb-3 text-xl font-bold text-text-primary lg:text-2xl" style="font-family: 'Poppins', sans-serif;">Nem hiba, hanem kerdes? Valasszon csatornat!</h3>
                        <p class="mb-5 text-base text-text-secondary">Ha nem technikai hibat szeretne jelezni, hanem kerdese van a rendszerrol, hasznaja az AI Chat-et (24/7) vagy irjon a support csapatunknak.</p>
                        <div class="flex flex-wrap gap-5">
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                AI Chat 24/7
                            </span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                E-mail support
                            </span>
                            <span class="flex items-center gap-1.5 text-sm text-text-tertiary">
                                <svg class="h-4 w-4 text-success-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                                Konzultacio
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('tamogatas') }}" class="group inline-flex items-center gap-2 rounded-full bg-danger-600 px-6 py-3 text-base font-medium text-white transition-all hover:bg-danger-700 hover:shadow-lg" style="box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                        <span>Tamogatas oldal</span>
                        <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Form Submit Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('bugForm');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const btn = document.getElementById('bugSubmitBtn');
                    btn.innerHTML = '&#10004; Bejelentes elkuldve — hamarosan e-mailt kap!';
                    btn.classList.remove('bg-danger-600', 'hover:bg-danger-700');
                    btn.classList.add('bg-success-600', 'hover:bg-success-700');
                    btn.style.boxShadow = '0 4px 24px rgba(0, 202, 114, 0.2)';
                    btn.style.pointerEvents = 'none';
                    setTimeout(function() {
                        btn.innerHTML = 'Hibabejelentes elkuldese <svg class="arrow-slide h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>';
                        btn.classList.remove('bg-success-600', 'hover:bg-success-700');
                        btn.classList.add('bg-danger-600', 'hover:bg-danger-700');
                        btn.style.boxShadow = '0 4px 24px rgba(251, 39, 93, 0.2)';
                        btn.style.pointerEvents = '';
                    }, 4000);
                });
            }
        });
    </script>

</div>
