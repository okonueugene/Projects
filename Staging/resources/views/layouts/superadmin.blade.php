<div class="row gy-4">
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label">Enter Site Name</label>
            <div class="form-control-wrap">
                <div class="form-icon form-icon-right">
                    <em class="icon ni ni-mail"></em>
                </div>
                <input type="email" wire:model='name' class="form-control" name="email" id="default-04"
                    placeholder="Enter site name">
                    @error('name')
                    <div class="form-note text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label">Enter Site Location</label>
            <div class="form-control-wrap">
                <div class="form-icon form-icon-right">
                    <em class="icon ni ni-location"></em>
                </div>
                <input type="email" wire:model='location' class="form-control location" name="location" id="default-04"
                    placeholder="Enter site location">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label">Select Timezone</label>
            <div class="form-control-wrap">
                <select wire:model='timezone' class="form-select timezone form-control form-control-lg" name="timezone" data-search="on">
                    <option value="nairobi">Nairobi</option>
                    <option value="uk">Europe</option>
                    <option value="tz"> Tanzania </option>
                </select>
                {{-- {!! $timezones !!} --}}
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="form-label">Select Client</label>
            <div class="form-control-wrap">
                <select wire:model='client' class="form-select timezone form-control form-control-lg" name="timezone"
                    data-search="on">
                    <option value="nairobi">Nairobi</option>
                    <option value="uk">Europe</option>
                    <option value="tz"> Tanzania </option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <button type="submit" class="btn btn-secondary addSiteButton"><span>Add Site</span></button>
    </div>
</div>