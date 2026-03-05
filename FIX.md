# Module Landing Page Standardization Guide

## Modules to update

| Module | Path | Landing page | Status |
|--------|------|-------------|--------|
| Controlling | `~/Herd/controlling` | `resources/views/home.blade.php` | done (steps 1-5) |
| CRM | `~/Herd/crm` | `resources/views/home.blade.php` | done (steps 1-5) |
| Workflow | `~/Herd/workflow` | `resources/views/home.blade.php` | |
| Beszerzés (Storage-cms) | `~/Herd/Storage-cms` | `resources/views/home.blade.php` | |
| SEO Eszköz | `~/Herd/stat-analitics` | `resources/views/home.blade.php` | |
| Értékesítés | `~/Herd/crm-and-contacts` | `resources/views/home.blade.php` | done (steps 1-5) |
| Munkalap | `~/Herd/worksheet` | `resources/views/home.blade.php` | |

Also update: `~/Herd/workflow/docs/design-system/05-landing-page-sections.md`

---

## 1. CTA button text and link standardization

### Button text

| Old text | New text |
|----------|----------|
| Próbálja ki 14 napig ingyen | Vágjunk bele |
| Próbálja ki 14 napig ingzen (typo) | Vágjunk bele |
| Ingyenes próba | Vágjunk bele |
| Ingyenes próba indítása | Vágjunk bele |
| Kipróbálom | Vágjunk bele |
| Kezdés most | Vágjunk bele |
| Demó kérése | Demót kérek |
| Demó időpont foglalása | Időpontot foglalok |
| Demó időpontot kérek | Időpontot foglalok |
| Ajánlat kérése | **Keep as is** (Enterprise tier) |

### CTA button group (3 buttons in one row)

Every CTA group (hero + final CTA) must have all three buttons in a single flex row:

| Button | Text | URL |
|--------|------|-----|
| Primary (filled) | Vágjunk bele | `https://cegem360.eu/register` |
| Secondary (outline) | Demót kérek | `https://cegem360.eu/kapcsolat` |
| Tertiary (text link) | Bejelentkezés a programba → | `/login` |

Replace all old hrefs (`/admin`, `#`, etc.) with the correct URLs above.

---

## 2. Remove free trial references

Delete or rewrite any text containing:
- "14 napos ingyenes próbaidőszak"
- "Bankkártya nélkül"
- "Nincs elkötelezettség, nem szükséges bankkártya"
- "Próbálja ki a Cégem360 ... modult 14 napig ingyenesen"
- "Kezdje el 14 napos ingyenes próbaidőszakkal"
- "Indítsa el 14 napos ingyenes próbaidőszakát"
- "Minden csomag tartalmaz 14 napos ingyenes próbaidőszakot"
- "kipróbálom ingyen"

### FAQ section

| Old | New |
|-----|-----|
| Mi történik a próbaidőszak után? | Mi történik a regisztráció után? |
| A 14 napos próbaidőszak után választhat: előfizet valamelyik csomagra, vagy a fiók inaktívvá válik. Az adatait 30 napig megőrizzük, utána töröljük. | A regisztráció után azonnal elérhető a választott csomag. Ha mégsem szeretné folytatni, bármikor lemondhatja az előfizetést. |

### Final CTA section description

Replace free trial descriptions with:
> Fedezze fel, hogyan segíti a Cégem360 a cége növekedését. Nincs hosszú távú elkötelezettség.

---

## 3. Delete trust badges

Remove these trust badge items entirely (the `<span>` elements):
- "Bankkártya nélkül indíthat"
- "5 perc alatt beüzemelhető"
- "Magyar nyelvű támogatás"
- "Bármikor lemondható" (if it references free trial context)

If the trust badges section becomes empty, remove the whole container `<div>`.

---

## 4. Hide testimonials section

Comment out or delete the "Amit ügyfeleink mondanak" section entirely.

---

## 5. Hide pricing section

Hide the entire pricing section with `@if(false) ... @endif` (same as testimonials).

Before hiding, ensure CTAs inside pricing are also standardized:
- Starter/Professional tier buttons: "Ingyenes próba" / "Kipróbálom" → "Vágjunk bele"
- Enterprise tier button: "Ajánlat kérése" → keep as is
- Remove "14 napos ingyenes próbaidőszak" from pricing trust badges

---

## 6. EN/HU localization (i18n)

Wrap all hardcoded Hungarian text in `{{ __('English key') }}` translation helpers.

### Current state per module

| Module | home.blade.php | navbar | footer | hu.json | Infrastructure |
|--------|---------------|--------|--------|---------|---------------|
| Controlling | 0 __() / 1192 lines | ✅ done | ✅ done | 461 lines | ✅ all present |
| CRM | ✅ 131 __() / 838 lines | ✅ done | ✅ done | 1188 lines | ✅ all present |
| Workflow | 0 __() / 1174 lines | ❌ 0 __() | ❌ 0 __() | ❌ missing | ✅ middleware+route+switcher |
| Beszerzés | 0 __() / 1053 lines | ✅ partial | ❌ 0 __() | 751 lines | ✅ all present |
| SEO Eszköz | ✅ 100 __() / 743 lines | ✅ done | ✅ done | 632 lines | ✅ all present |
| Értékesítés | ✅ 171 __() / 1079 lines | ✅ done | inline in home | 639 lines | ✅ all present |
| Munkalap | 0 __() / 1032 lines | ❌ not checked | ❌ no footer file | 43 lines | ✅ all present |

**Reference:** subscriber has 189 __() calls in home.blade.php and ~3120 entries in hu.json.

### Strategy — lessons from subscriber i18n

The subscriber project's i18n was done with automated scripts that caused **corrupted hu.json entries** — HTML/SVG/CSS leaked into translation values, and keys got shifted to wrong values. The recovery required rebuilding hu.json from scratch using `git diff` to match original Hungarian text with new `__('key')` wrappers.

**Do NOT repeat these mistakes. Follow this manual approach:**

#### Per-module workflow

1. **Work one file at a time** (home → navbar → footer), one module at a time
2. **For each piece of visible Hungarian text:**
   - Choose a concise English key (check subscriber's `lang/hu.json` for existing key conventions)
   - Replace `Hungarian text` → `{{ __('English key') }}`
   - Immediately add `"English key": "Hungarian text"` to that module's `lang/hu.json`
3. **Never use automated extraction scripts** — they cause value corruption
4. **Skip text inside HTML attributes** that aren't user-visible (e.g. internal `id`, `class`)
5. **Do localize:** headings, paragraphs, button text, list items, alt text, placeholder text, aria-labels
6. **Don't localize:** brand names ("Cégem360"), URLs, code/technical strings, `@if(false)` hidden sections

#### What to wrap

```blade
{{-- Before --}}
<h2>Minden, amire szüksége van</h2>

{{-- After --}}
<h2>{{ __('Everything you need') }}</h2>
```

For text with embedded HTML:
```blade
{{-- Before --}}
<p>Próbálja ki <strong>ingyen</strong></p>

{{-- After --}}
<p>{!! __('Try it <strong>for free</strong>') !!}</p>
```

#### Key naming conventions (from subscriber)

- Use natural English sentences/phrases as keys: `'Everything you need'`, `'Get started'`
- Keep keys short but descriptive
- For section headings, use the full heading text
- For repeated text (like "Get started"), reuse the same key across files
- For module-specific text, still use English — the hu.json provides the Hungarian

#### Files to localize per module

- `resources/views/home.blade.php` — landing page (biggest job)
- `resources/views/components/layouts/navbar.blade.php` — navigation
- `resources/views/components/layouts/footer.blade.php` — footer (some modules have inline footer)

#### hu.json management

- If `lang/hu.json` already exists, **merge new entries** into it (don't overwrite)
- Keep entries sorted alphabetically by key
- Validate: no HTML tags in values unless they also appear in the key (e.g. `<strong>`)
- After each module, verify with `grep -c '__(' <file>` that coverage is complete

#### Infrastructure (already present in all modules)

All 7 modules already have:
- `app/Http/Middleware/SetLocale.php` — reads locale from cookie
- `routes/web.php` — `/language/{locale}` route named `language.switch`
- `resources/views/components/language-switcher.blade.php` — HU/EN toggle

Only Workflow is missing `lang/hu.json` — create it fresh.

#### Order of execution

Start with modules that already have partial i18n done:
1. ~~SEO Eszköz~~ — already mostly done (100 __() calls), verify + fill gaps
2. ~~Értékesítés~~ — already mostly done (171 __() calls), 3 missing entries added
3. ~~CRM~~ — navbar/footer done, home fully localized (131 __() calls)
4. Controlling — navbar/footer done, home needs full i18n
5. Beszerzés — navbar partial, footer + home need i18n
6. Munkalap — everything needs i18n
7. Workflow — everything needs i18n (+ create hu.json)

---

## 7. Update design system docs

Update `~/Herd/workflow/docs/design-system/05-landing-page-sections.md`:
- Hero CTA: "Próbálja ki 14 napig ingyen" → "Vágjunk bele"
- Hero secondary: "Demó kérése" → "Demót kérek"
- Pricing buttons: "Kipróbálom" / "Kezdés most" → "Vágjunk bele"
- Final CTA: "Ingyenes próba indítása" → "Vágjunk bele"
- Final CTA secondary: "Beszéljen szakértőnkkel" → "Időpontot foglalok"
- Remove trust badge examples with free trial text
- Remove testimonials section from standard section order

---

## Verification checklist (per module)

- [ ] No "ingyen" / "ingyenes" / "14 nap" / "próba" / "kipróbál" text remains
- [ ] No "Bankkártya nélkül" trust badges
- [ ] CTA buttons use standardized text
- [ ] Testimonials section hidden/removed
- [ ] All visible Hungarian text wrapped in `__()`
- [ ] `lang/hu.json` created with all translations
- [ ] Navbar and footer localized
- [ ] Page renders correctly in both HU and EN
