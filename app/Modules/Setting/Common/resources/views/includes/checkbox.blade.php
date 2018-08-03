<input type="hidden" value="0" name="{{ $setting }}">
<input name="{{ $setting }}" type="checkbox"  class="custom-switch-input" value="1"{{ setting($setting) ? 'checked' : '' }} >
