<?php
/**
 * @file
 * Contains \Drupal\calculator\Plugin\AreaCalculator.
 */

 namespace Drupal\calculator\Plugin\Calculator;

 use Drupal\calculator\CalculatorBase;
 use Drupal\Core\Form\FormStateInterface;
 use Drupal\Core\Url;
 use Drupal\Core\Ajax\AjaxResponse;
 use Drupal\Core\Ajax\OpenModalDialogCommand;


/**
 * Demonstrates various area calculators
 *
 * @Calculator(
 *   id = "bmi_calculator",
 *   title = "Bmi Calculator",
 *   description = @Translation("Bmi Calculator"),
 * )
 */
class BodyMassIndexCalculator extends CalculatorBase {

  public function calculatorForm(array $form, FormStateInterface $form_state){

    $form['bmi'] = [
      '#type' => 'details',
      "#title" => "BMI",
      '#open' => TRUE
    ];

    $form['bmi']['height'] = [
      '#type' => 'number',
      '#min'=> 1,
      '#step' => 'any',
      '#title' => t('Height in meters'),
    ];

    $form['bmi']['weight'] = [
      '#type' => 'number',
      '#min'=> 1,
      '#title' => t('Weight in kgs'),
    ];

    $form['bmi']['actions'] = array('#type' => 'actions');
    $form['bmi']['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => 'Calculate',
      '#name' => 'cal_bmi',
    ];

    return $form;
  }

  public function calculatorFormValidate(array &$form, FormStateInterface $form_state){}

  public function calculatorFormSubmit(array &$form, FormStateInterface $form_state){
    $values_submitted  = $form_state->getValues();
    if(isset($values_submitted['cal_bmi'])){
      $area = $values_submitted['weight'] / $values_submitted['height'];
      $area = $area/$values_submitted['height'];
      drupal_set_message(t('Body Mass Index  is : @area', ['@area' =>  $area]), 'status', FALSE);
    }
  }
}
