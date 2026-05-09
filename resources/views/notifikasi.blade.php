@include('base.header')

<style>
    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Raleway', sans-serif;
        background-color: #f4f6f9;
        min-height: 100vh;
    }

    .notif-wrapper {
        max-width: 780px;
        margin: 40px auto;
        padding: 0 20px 60px;
    }

    /* ── PAGE HEADER ── */
    .page-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 30px;
    }
    .page-header .icon-wrap {
        width: 48px; height: 48px;
        background: #980517;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
    }
    .page-header .icon-wrap i { color: #fff; font-size: 1.3rem; }
    .page-header h2 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #980517;
        margin: 0;
    }
    .page-header p {
        font-size: 0.83rem;
        color: #888;
        margin: 0;
    }

    /* ── SECTION TITLE ── */
    .section-title {
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #aaa;
        margin: 28px 0 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #e5e5e5;
    }

    /* ── CARD ── */
    .notif-card {
        background: #fff;
        border-radius: 14px;
        border-left: 4px solid transparent;
        padding: 16px 20px;
        margin-bottom: 10px;
        box-shadow: 0 1px 6px rgba(0,0,0,0.06);
        display: flex;
        align-items: flex-start;
        gap: 14px;
        transition: box-shadow 0.2s, transform 0.2s;
    }
    .notif-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.10);
        transform: translateY(-1px);
    }
    .notif-card.type-pengumuman { border-left-color: #980517; }
    .notif-card.type-catatan    { border-left-color: #e07b00; }
    .notif-card.type-empty      { border-left-color: #dee2e6; opacity: 0.7; }

    .notif-icon {
        width: 38px; height: 38px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        font-size: 1rem;
    }
    .notif-icon.red    { background: #fff0f0; color: #980517; }
    .notif-icon.orange { background: #fff5e6; color: #e07b00; }
    .notif-icon.gray   { background: #f0f0f0; color: #aaa; }

    .notif-body { flex: 1; min-width: 0; }
    .notif-body .notif-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #aaa;
        margin-bottom: 3px;
    }
    .notif-body .notif-title {
        font-size: 0.92rem;
        font-weight: 600;
        color: #2c2c2c;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .notif-body .notif-text {
        font-size: 0.83rem;
        color: #555;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .notif-body .notif-text.empty-text {
        color: #aaa;
        font-style: italic;
    }
    .notif-meta {
        font-size: 0.75rem;
        color: #bbb;
        white-space: nowrap;
        padding-top: 2px;
        flex-shrink: 0;
        text-align: right;
        min-width: 70px;
    }

    /* ── BADGE NEW ── */
    .badge-new {
        display: inline-block;
        background: #980517;
        color: #fff;
        font-size: 0.62rem;
        font-weight: 700;
        padding: 2px 7px;
        border-radius: 20px;
        margin-left: 6px;
        vertical-align: middle;
        letter-spacing: 0.04em;
    }

    /* ── EMPTY STATE ── */
    .empty-state {
        text-align: center;
        padding: 50px 20px;
        color: #bbb;
    }
    .empty-state i { font-size: 3rem; margin-bottom: 12px; display: block; }
    .empty-state p { font-size: 0.9rem; }

    /* ── BACK BUTTON ── */
    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fff;
        border: 1px solid #ddd;
        color: #555;
        padding: 8px 18px;
        border-radius: 10px;
        font-size: 0.85rem;
        text-decoration: none;
        margin-bottom: 24px;
        transition: 0.2s;
    }
    .btn-back:hover { border-color: #980517; color: #980517; background: #fff8f8; }

    /* ── SUMMARY BAR ── */
    .summary-bar {
        display: flex;
        gap: 12px;
        margin-bottom: 28px;
        flex-wrap: wrap;
    }
    .summary-pill {
        background: #fff;
        border-radius: 10px;
        padding: 10px 18px;
        font-size: 0.83rem;
        box-shadow: 0 1px 5px rgba(0,0,0,0.07);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .summary-pill .pill-count {
        font-weight: 700;
        font-size: 1.1rem;
    }
    .summary-pill.red .pill-count  { color: #980517; }
    .summary-pill.orange .pill-count { color: #e07b00; }

    @media (max-width: 600px) {
        .notif-meta { display: none; }
        .notif-body .notif-title { white-space: normal; }
    }
</style>

<div class="notif-wrapper">

    {{-- Back button --}}
    <a href="{{ route('beranda') }}" class="btn-back">
        <i class="bi bi-arrow-left"></i> Back to Home
        <em style="font-size:0.78rem; color:#aaa;">Kembali ke Beranda</em>
    </a>

    {{-- Page Header --}}
    <div class="page-header">
        <div class="icon-wrap"><i class="bi bi-bell-fill"></i></div>
        <div>
            <h2>Notifications <em style="font-size:0.85rem; font-weight:400; color:#aaa;">Notifikasi</em></h2>
            <p>Your graduation announcements & department notes — <em>Pengumuman wisuda & catatan dari unit terkait</em></p>
        </div>
    </div>

    {{-- Summary Bar --}}
    <div class="summary-bar">
        <div class="summary-pill red">
            <i class="bi bi-megaphone-fill" style="color:#980517;"></i>
            <span>Announcements — <em style="color:#aaa; font-size:0.78rem;">Pengumuman</em></span>
            <span class="pill-count red">{{ count($informasi) }}</span>
        </div>
        <div class="summary-pill orange">
            <i class="bi bi-chat-left-text-fill" style="color:#e07b00;"></i>
            <span>Department Notes — <em style="color:#aaa; font-size:0.78rem;">Catatan Unit</em></span>
            <span class="pill-count orange">{{ $totalCatatan }}</span>
        </div>
        </div>
    </div>

    {{-- ══════════════════════════════════ --}}
    {{-- SECTION 1: PENGUMUMAN / INFORMASI  --}}
    {{-- ══════════════════════════════════ --}}
    <div class="section-title">
        <i class="bi bi-megaphone-fill" style="color:#980517;"></i>
        Announcements — <em style="font-style:normal; color:#bbb; text-transform:none; letter-spacing:0; font-size:0.75rem;">Pengumuman dari Admin</em>
    </div>

    @forelse($informasi as $info)
    <div class="notif-card type-pengumuman">
        <div class="notif-icon red"><i class="bi bi-megaphone-fill"></i></div>
        <div class="notif-body">
            <div class="notif-label">Graduation Announcement — <em>Pengumuman Wisuda</em></div>
            <div class="notif-title">
                📍 {{ $info->lokasi }}
                @if($info->created_at >= $lastSeen)
                    <span class="badge-new">NEW</span>
                @endif
            </div>
            <div class="notif-text">
                📅 {{ \Carbon\Carbon::parse($info->jadwal_wisuda)->translatedFormat('d F Y') }} &nbsp;•&nbsp;
                🎓 {{ number_format($info->jumlah_wisudawan) }} graduates
                @if($info->informasi_baak)
                    &nbsp;•&nbsp; {{ $info->informasi_baak }}
                @endif
            </div>
        </div>
        <div class="notif-meta">{{ \Carbon\Carbon::parse($info->created_at)->diffForHumans() }}</div>
    </div>
    @empty
    <div class="notif-card type-empty">
        <div class="notif-icon gray"><i class="bi bi-megaphone"></i></div>
        <div class="notif-body">
            <div class="notif-text empty-text">No announcements yet — Belum ada pengumuman.</div>
        </div>
    </div>
    @endforelse

    {{-- ══════════════════════════════════ --}}
    {{-- SECTION 2: CATATAN DARI UNIT       --}}
    {{-- ══════════════════════════════════ --}}
    <div class="section-title">
        <i class="bi bi-chat-left-text-fill" style="color:#e07b00;"></i>
        Department Notes — <em style="font-style:normal; color:#bbb; text-transform:none; letter-spacing:0; font-size:0.75rem;">Catatan dari Unit Terkait</em>
    </div>

    @if($pendaftaran)

        {{-- Catatan Fakultas --}}
        <div class="notif-card type-catatan">
            <div class="notif-icon orange"><i class="bi bi-building"></i></div>
            <div class="notif-body">
                <div class="notif-label">Faculty — <em>Fakultas</em></div>
                <div class="notif-title">Faculty Note</div>
                @if($pendaftaran->catatan_fakultas)
                    <div class="notif-text">{{ $pendaftaran->catatan_fakultas }}</div>
                @else
                    <div class="notif-text empty-text">No notes yet — Belum ada catatan.</div>
                @endif
            </div>
            <div class="notif-meta">
                @if($pendaftaran->catatan_fakultas)
                    <i class="bi bi-check-circle-fill" style="color:#198754;"></i>
                @else
                    <i class="bi bi-clock" style="color:#ccc;"></i>
                @endif
            </div>
        </div>

        {{-- Catatan BAAK --}}
        <div class="notif-card type-catatan">
            <div class="notif-icon orange"><i class="bi bi-journal-text"></i></div>
            <div class="notif-body">
                <div class="notif-label">BAAK — <em>Biro Administrasi Akademik</em></div>
                <div class="notif-title">BAAK Note</div>
                @if($pendaftaran->catatan_baak)
                    <div class="notif-text">{{ $pendaftaran->catatan_baak }}</div>
                @else
                    <div class="notif-text empty-text">No notes yet — Belum ada catatan.</div>
                @endif
            </div>
            <div class="notif-meta">
                @if($pendaftaran->catatan_baak)
                    <i class="bi bi-check-circle-fill" style="color:#198754;"></i>
                @else
                    <i class="bi bi-clock" style="color:#ccc;"></i>
                @endif
            </div>
        </div>

        {{-- Catatan Perpustakaan --}}
        <div class="notif-card type-catatan">
            <div class="notif-icon orange"><i class="bi bi-book"></i></div>
            <div class="notif-body">
                <div class="notif-label">Library — <em>Perpustakaan</em></div>
                <div class="notif-title">Library Note</div>
                @if($pendaftaran->catatan_perpus)
                    <div class="notif-text">{{ $pendaftaran->catatan_perpus }}</div>
                @else
                    <div class="notif-text empty-text">No notes yet — Belum ada catatan.</div>
                @endif
            </div>
            <div class="notif-meta">
                @if($pendaftaran->catatan_perpus)
                    <i class="bi bi-check-circle-fill" style="color:#198754;"></i>
                @else
                    <i class="bi bi-clock" style="color:#ccc;"></i>
                @endif
            </div>
        </div>

        {{-- Catatan Keuangan --}}
        <div class="notif-card type-catatan">
            <div class="notif-icon orange"><i class="bi bi-cash-coin"></i></div>
            <div class="notif-body">
                <div class="notif-label">Finance — <em>Keuangan</em></div>
                <div class="notif-title">Finance Note</div>
                @if($pendaftaran->catatan_finance)
                    <div class="notif-text">{{ $pendaftaran->catatan_finance }}</div>
                @else
                    <div class="notif-text empty-text">No notes yet — Belum ada catatan.</div>
                @endif
            </div>
            <div class="notif-meta">
                @if($pendaftaran->catatan_finance)
                    <i class="bi bi-check-circle-fill" style="color:#198754;"></i>
                @else
                    <i class="bi bi-clock" style="color:#ccc;"></i>
                @endif
            </div>
        </div>

        {{-- Catatan CSDL --}}
        <div class="notif-card type-catatan">
            <div class="notif-icon orange"><i class="bi bi-database"></i></div>
            <div class="notif-body">
                <div class="notif-label">CSDL — <em>Center for Student Data & Learning</em></div>
                <div class="notif-title">CSDL Note</div>
                @if($pendaftaran->catatan_csdl)
                    <div class="notif-text">{{ $pendaftaran->catatan_csdl }}</div>
                @else
                    <div class="notif-text empty-text">No notes yet — Belum ada catatan.</div>
                @endif
            </div>
            <div class="notif-meta">
                @if($pendaftaran->catatan_csdl)
                    <i class="bi bi-check-circle-fill" style="color:#198754;"></i>
                @else
                    <i class="bi bi-clock" style="color:#ccc;"></i>
                @endif
            </div>
        </div>

    @else
        {{-- Belum daftar wisuda --}}
        <div class="notif-card type-empty">
            <div class="notif-icon gray"><i class="bi bi-info-circle"></i></div>
            <div class="notif-body">
                <div class="notif-text empty-text">
                    You haven't registered for graduation yet, so there are no department notes. —
                    <em>Anda belum mendaftar wisuda, belum ada catatan dari unit.</em>
                </div>
            </div>
        </div>
    @endif



</div>

<footer class="content-footer footer bg-footer-theme" style="background:#f8f9fa; border-top:1px solid #e7e9ed; padding:1.5rem 0; margin-top:2rem;">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-3 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            © <script>document.write(new Date().getFullYear());</script> Horizon University | All Rights Reserved
        </div>
        <div>
            <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank" style="color:#566a7f; text-decoration:none;">License</a>
            <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4" style="color:#566a7f; text-decoration:none;">Documentation</a>
            <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4" style="color:#566a7f; text-decoration:none;">Support</a>
        </div>
    </div>
</footer>