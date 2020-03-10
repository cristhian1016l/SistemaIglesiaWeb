@extends('layouts.app')
    @section('content')

    @if(Auth::check())
            @if (Auth::user()->isLidercdp())
            <template v-if="menu==0">
                <cdp></cdp>
            </template>

            <template v-if="menu==1">
                <informe></informe>
            </template>

            <template v-if="menu==2">
                <informeenviado></informeenviado>
            </template>

            @elseif (Auth::user()->isLiderred())
            <template v-if="menu==3">
                <cdps></cdps>
            </template>     
            <template v-if="menu==4">
                <informerecibido></informerecibido>
            </template>      
            <template v-if="menu==5">
                <usuario></usuario>
            </template>      
            @else

            @endif

      @endif
             
    @endsection