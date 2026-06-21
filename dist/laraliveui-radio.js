// laraliveui radio components — patches missing <ui-radio-group> / <ui-radio> custom elements
// Released under the MIT license.
(function() {
  if (typeof customElements === 'undefined' || customElements.get('ui-radio-group')) return;

  // ---------------------------------------------------------------------------
  // <ui-radio-group> — single-select group manager
  // ---------------------------------------------------------------------------
  const groupTemplate = document.createElement('template');
  groupTemplate.innerHTML = `<slot></slot>`;

  class UIRadioGroup extends HTMLElement {
    constructor() {
      super();
      this._value = null;
      this._disabled = false;
      this._init = false;
    }

    connectedCallback() {
      this.setAttribute('role', 'radiogroup');
      if (!this.hasAttribute('data-laraliveui-radio-group')) {
        this.setAttribute('data-laraliveui-radio-group', '');
      }

      this._disabled = this.hasAttribute('disabled');

      // wire up all current children
      this._connectChildren();

      // watch for dynamically added/removed radios
      if (!this._observer) {
        this._observer = new MutationObserver(() => this._connectChildren());
        this._observer.observe(this, { childList: true, subtree: true });
      }

      // initial value — group value > first [checked] radio
      if (this.hasAttribute('value') && this.getAttribute('value') !== '') {
        this._value = this.getAttribute('value');
      } else {
        const checked = this.querySelector('ui-radio[checked]');
        if (checked) {
          this._value = checked.getAttribute('value') || checked.textContent.trim();
        }
      }

      this._init = true;
      this._syncRadios();
    }

    disconnectedCallback() {
      if (this._observer) { this._observer.disconnect(); this._observer = null; }
    }

    static get observedAttributes() { return ['value', 'disabled']; }

    attributeChangedCallback(name, oldVal, newVal) {
      if (name === 'value' && oldVal !== newVal && this._init) {
        this._value = newVal !== null ? newVal : null;
        this._syncRadios();
      } else if (name === 'disabled') {
        this._disabled = newVal !== null;
      }
    }

    // ---- public value API (used by Alpine x-model) ---------------------------
    get value() { return this._value; }

    set value(val) {
      if (this._disabled) return;
      const str = val !== null && val !== undefined ? String(val) : null;
      if (this._value === str) return;
      this._value = str;
      if (!this.hasAttribute('value')) {
        this.setAttribute('value', str !== null ? str : '');
      }
      this._syncRadios();
      if (this._init && this.isConnected) {
        this.dispatchEvent(new CustomEvent('input', { bubbles: true }));
        this.dispatchEvent(new CustomEvent('change', { bubbles: true }));
      }
    }

    // ---- called by child <ui-radio> on click ---------------------------------
    _radioClicked(radio) {
      if (this._disabled) return;
      this.value = radio.getAttribute('value') || radio.textContent.trim();
    }

    // ---- internal ------------------------------------------------------------
    _connectChildren() {
      this.querySelectorAll('ui-radio').forEach(r => {
        if (r._group !== this) r._group = this;
      });
    }

    _syncRadios() {
      this.querySelectorAll('ui-radio').forEach(r => {
        const val = r.getAttribute('value') || r.textContent.trim();
        const checked = val === this._value;
        r.toggleAttribute('data-checked', checked);
        r.setAttribute('aria-checked', String(checked));
      });
    }
  }

  customElements.define('ui-radio-group', UIRadioGroup);

  // ---------------------------------------------------------------------------
  // <ui-radio> — individual radio button
  // ---------------------------------------------------------------------------
  class UIRadio extends HTMLElement {
    constructor() {
      super();
      this._group = null;
      this._disabled = false;
      this._boundClick = () => {
        if (this._disabled) return;
        // prefer explicit group reference, else walk up
        const group = this._group || this.closest('ui-radio-group') || this.closest('[role="radiogroup"]');
        if (group && group._radioClicked) {
          group._radioClicked(this);
        } else {
          // standalone (should not happen in normal usage)
          this.toggleAttribute('data-checked', true);
          this.setAttribute('aria-checked', 'true');
        }
      };
    }

    connectedCallback() {
      this._disabled = this.hasAttribute('disabled');
      if (this._disabled) this.setAttribute('aria-disabled', 'true');
      if (!this.hasAttribute('data-laraliveui-control')) {
        this.setAttribute('data-laraliveui-control', '');
      }
      this.addEventListener('click', this._boundClick);
      // find group lazily — the group might not be upgraded yet
      this._group = this.closest('ui-radio-group') || this.closest('[role="radiogroup"]');
    }

    disconnectedCallback() {
      this.removeEventListener('click', this._boundClick);
    }

    static get observedAttributes() { return ['disabled', 'value']; }

    attributeChangedCallback(name, oldVal, newVal) {
      if (name === 'disabled') {
        this._disabled = newVal !== null;
        this.toggleAttribute('aria-disabled', this._disabled);
        if (!this._disabled) this.removeAttribute('data-checked');
      }
    }

    get value() {
      return this.getAttribute('value') !== null
        ? this.getAttribute('value')
        : this.textContent.trim();
    }

    get disabled() { return this._disabled; }
    set disabled(val) { this.toggleAttribute('disabled', !!val); }
  }

  customElements.define('ui-radio', UIRadio);
})();
