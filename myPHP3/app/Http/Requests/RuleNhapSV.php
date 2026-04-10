<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleNhapSV extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'masv' => ['required', 'min:3', 'max:20'],
            'hoten' => ['required', 'min:3', 'max:50'],
            'tuoi' => ['required', 'integer', 'min:16', 'max:100'],
            'ngaysinh' => ['required', 'date'],
            'cmnd' => ['required', 'digits_between:9,12'],
            'email' => ['required', 'email'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute là bắt buộc.',
            'min' => ':attribute phải có ít nhất :min ký tự.',
            'max' => ':attribute không được vượt quá :max ký tự.',
            'integer' => ':attribute phải là số nguyên.',
            'date' => ':attribute không đúng định dạng ngày.',
            'email' => ':attribute không đúng định dạng.',
            'digits_between' => ':attribute phải có độ dài từ :min đến :max ký tự số.',
        ];
    }

    public function attributes(): array
    {
        return [
            'masv' => 'Mã sinh viên',
            'hoten' => 'Họ tên',
            'tuoi' => 'Tuổi',
            'ngaysinh' => 'Ngày sinh',
            'cmnd' => 'CMND/CCCD',
            'email' => 'Email',
        ];
    }
}
