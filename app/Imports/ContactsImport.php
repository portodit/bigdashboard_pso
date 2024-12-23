<?php
namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow; 

class ContactsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {

        if (empty($row['company_name']) || empty($row['individual_name']) || empty($row['email'])) {
            // Mengabaikan baris ini jika kolom wajib kosong
            return null;
        }

        return new Contact([
            'company_name' => $row['company_name'],  // Menggunakan nama kolom dari header
            'company_type' => $row['company_type'],
            'individual_name' => $row['individual_name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'job_title' => $row['job_title'],
            'location' => $row['location'],
            'date_added' => now(),
            'lead_status' => 'Cold Leads'
        ]);
    }
}
