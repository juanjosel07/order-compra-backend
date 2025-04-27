<?php

namespace App\Dto;

class OrderDTO
{
    public string $client_name;
    public string $order_date;
    public string $payment_method;
    public float $discount;
    public ?string $observations;
    public float $total;
    public array $orderItems;

    public function __construct(array $data)
    {
        $this->client_name = $data['client_name'];
        $this->order_date = $data['order_date'];
        $this->payment_method = $data['payment_method'];
        $this->discount = (float) $data['discount'];
        $this->observations = $data['observations'] ?? null;
        $this->total = (float) $data['total'];
        $this->orderItems = $data['orderItems'];
    }

    public function toArray(): array
    {
        return [
            'client_name' => $this->client_name,
            'order_date' => $this->order_date,
            'payment_method' => $this->payment_method,
            'discount' => $this->discount,
            'observations' => $this->observations,
            'total' => $this->total,
        ];
    }
}
