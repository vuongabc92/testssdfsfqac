<section id="settingUsername">
    <div class="_fwfl settings-row">
        <div class="_fl col-md-3 col-xs-12">
            <b class="settings-row-title">{{ _t('setting.profile.uname') }}</b>
        </div>
        <div class="_fl col-md-9 col-xs-12">
            <div class="settings-show">
                <div class="_fl col-no-padding col-md-11 col-xs-11 ">
                    <b class="_fwfl" id="currentUsername">{{ user()->username }}</b>
                </div>
                <div class="_fr col-no-padding col-md-1 col-xs-1">
                    <button type="button" class="settings-expand-btn" data-show-form><i class="fa fa-pencil"></i></button>
                </div>
            </div>
            {!! Form::open(['route' => 'front_settings_save_info', 'method' => 'POST', 'class' => 'settings-form', 'data-save-form' => '', 'data-requires' => 'username']) !!}
            <div class="settings-field-wrapper _pr">
                {!! Form::text('username', user()->username, ['class' => 'settings-field', 'placeholder' => _t('setting.profile.uname')]) !!}
            </div>
            <span class="_fwfl settings-help-text _mb10">
                <p class="_mb1 _tr5">{{ _t('setting.profile.update_uname') }}</p>
            </span>
            <button type="submit" class="btn _btn _btn-sm _btn-blue-navy _mr8">{{ _t('save') }}</button>
            <button type="reset" class="btn _btn _btn-sm _btn-gray" data-hide-form>{{ _t('cancel') }}</button>
            <input type="hidden" name="type" value="_USERNAME"/>
            {!! Form::close() !!}
        </div>
    </div>
</section>