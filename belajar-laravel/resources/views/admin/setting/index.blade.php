@extends('admin.dashboard.index')
@section('title', 'Pengaturan Website')
@section('subtitle', 'Konfigurasi identitas website, logo, kontak dan informasi profil')

@section('content')
    <div class="card">
        <form action="{{ route('admin.settings.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <ul class="nav nav-tabs mb-3" id="defaultTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active text-dark" id="home-tab" data-bs-toggle="tab"
                            data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                            aria-selected="true">
                            <i class="bi bi-house-door me-1"></i> Pengaturan Umum
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile-tab-pane" type="button" role="tab"
                            aria-controls="profile-tab-pane" aria-selected="false" tabindex="-1">
                            <i class="bi bi-telephone me-1"></i> Kontak & Lokasi
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark" id="messages-tab" data-bs-toggle="tab"
                            data-bs-target="#messages-tab-pane" type="button" role="tab"
                            aria-controls="messages-tab-pane" aria-selected="false" tabindex="-1">
                            <i class="bi bi-chat-dots me-1"></i> Media Sosial
                        </button>
                    </li>
                </ul>

                <div class="tab-content text-muted-green small" id="defaultTabsContent">
                    <!-- Tab Pengaturan Umum -->
                    <div class="tab-pane fade active show mt-4" id="home-tab-pane" role="tabpanel"
                        aria-labelledby="home-tab" tabindex="0">
                        <h5 class="fw-bold text-main mb-1">Pengaturan Umum</h5>
                        <div class="mb-3">
                            <label class="form-label">Nama Lembaga / Nama Website</label>
                            <input type="text" class="form-control" name="site_name"
                                value="{{ old('site_name', optional($setting['site_name'] ?? null)->value) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tagline Website</label>
                            <input type="text" class="form-control" name="site_tagline"
                                value="{{ old('site_tagline', optional($setting['site_tagline'] ?? null)->value) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi Singkat</label>
                            <textarea name="site_description" class="form-control" cols="30" rows="5">{{ old('site_description', optional($setting['site_description'] ?? null)->value) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label d-block">Logo Website</label>
                            <input type="file" name="site_logo" class="form-control mb-2">
                            @if (isset($setting['site_logo']) && $setting['site_logo']->value)
                                <div>
                                    <img src="{{ asset('storage/' . $setting['site_logo']->value) }}" alt="Logo"
                                        width="120" class="img-thumbnail">
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Tab Kontak & Lokasi -->
                    <div class="tab-pane fade pt-4" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                        tabindex="0">
                        <h5 class="fw-bold text-main mb-3">Kontak dan Lokasi</h5>
                        <div class="mb-3">
                            <label class="form-label">Nomer Telpon Utama</label>
                            <input type="text" class="form-control" name="phone"
                                value="{{ old('phone', optional($setting['phone'] ?? null)->value) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Upload</label>
                            <input type="email" class="form-control" name="email_upload"
                                value="{{ old('email_upload', optional($setting['email_upload'] ?? null)->value) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" cols="30" rows="5" name="address">{{ old('address', optional($setting['address'] ?? null)->value) }}</textarea>
                        </div>
                    </div>

                    <!-- Tab Media Sosial -->
                    <div class="tab-pane fade pt-4" id="messages-tab-pane" role="tabpanel"
                        aria-labelledby="messages-tab" tabindex="0">
                        <h5 class="fw-bold text-main mb-1">Sosial Media</h5>
                        <div class="mb-3">
                            <label class="form-label">Url Shopee</label>
                            <input type="url" class="form-control" name="url_shopee"
                                value="{{ old('url_shopee', optional($setting['url_shopee'] ?? null)->value) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Url Facebook</label>
                            <input type="url" class="form-control" name="url_facebook"
                                value="{{ old('url_facebook', optional($setting['url_facebook'] ?? null)->value) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Url Instagram</label>
                            <input type="url" class="form-control" name="url_instagram"
                                value="{{ old('url_instagram', optional($setting['url_instagram'] ?? null)->value) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Url Youtube</label>
                            <input type="url" class="form-control" name="url_youtube"
                                value="{{ old('url_youtube', optional($setting['url_youtube'] ?? null)->value) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Url Tiktok</label>
                            <input type="url" class="form-control" name="url_tiktok"
                                value="{{ old('url_tiktok', optional($setting['url_tiktok'] ?? null)->value) }}">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>
@endsection
