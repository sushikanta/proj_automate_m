import {Directive, ElementRef, HostListener, Input} from '@angular/core';

@Directive({
  selector: '[appXDigitDecimal]'
})
export class XDigitDecimalDirective {
  @Input() decimalDigit: any = 2;
  private specialKeys: Array<string> = ['Backspace', 'Tab', 'End', 'Home', '-', 'ArrowLeft', 'ArrowRight', 'Del', 'Delete'];

  constructor(
    private el: ElementRef
  ) { }

  @HostListener('keydown', ['$event'])
  onKeyDown(event: KeyboardEvent) {

    // Allow Backspace, tab, end, and home keys
    if (this.specialKeys.indexOf(event.key) !== -1) {
      return;
    }

    const current: string = this.el.nativeElement.value;
    const position = this.el.nativeElement.selectionStart;
    const slicedStr = current.slice(0, position);
    const evtKeyStr =  event.keyCode === 190 ? '.' : event.key;
    const sliced2Str = current.slice(position);
    const next: string = [slicedStr, evtKeyStr, sliced2Str].join('');

    let regex: RegExp;
    if (this.decimalDigit === 3){
      regex  = new RegExp(/^\d*\.?\d{0,3}$/g);
    } else if (this.decimalDigit === 4){
      regex  = new RegExp(/^\d*\.?\d{0,4}$/g);
    } else{
      // 2 decimal by default
      regex  = new RegExp(/^\d*\.?\d{0,2}$/g);
    }

    if (next && !String(next).match(regex)) {
      event.preventDefault();
    }
  }
}

